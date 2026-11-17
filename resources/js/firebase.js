import { initializeApp, cert } from "firebase-admin/app";
import { getFirestore } from "firebase-admin/firestore";
const serviceAccount = JSON.parse(import.meta.env.VITE_FIREBASE_CREDENTIALS);

initializeApp({
  credential: cert(serviceAccount)
});

export const db = getFirestore();