import db from "./firebase.js";
import exportData from "./warung_mbah_darmo.json" with { type: "json" };

async function uploadFullDatabase() {
    // Ambil hanya objek yang memiliki type "table"
    const tables = exportData.filter((item) => item.type === "table");

    if (tables.length === 0) {
        console.log("Tidak ada data tabel yang ditemukan.");
        return;
    }

    for (const tableObj of tables) {
        const collectionName = tableObj.name;
        const rows = tableObj.data;

        // Lewati jika tabel tidak memiliki data (seperti cache, jobs, dll)
        if (!rows || rows.length === 0) {
            console.log(`Koleksi "${collectionName}" kosong, dilewati.`);
            continue;
        }

        // Firestore membatasi maksimal 500 operasi batch per commit
        const chunkSize = 400;
        for (let i = 0; i < rows.length; i += chunkSize) {
            const chunk = rows.slice(i, i + chunkSize);
            const batch = db.batch();

            chunk.forEach((row) => {
                const docRef = row.id
                    ? db.collection(collectionName).doc(String(row.id))
                    : db.collection(collectionName).doc();

                batch.set(docRef, row);
            });

            await batch.commit();
        }

        console.log(`Berhasil mengunggah ${rows.length} data ke koleksi "${collectionName}"`);
    }

    console.log("Semua data berhasil dimigrasi ke Firestore!");
}

uploadFullDatabase().catch(console.error);