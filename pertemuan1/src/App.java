public class App {
    public static void main(String[] args) {
        System.out.println("=== Rekap Nilai ===");
        Mahasiswa[] kelas = {
            new Mahasiswa("2024001", "Ani Lestari",  85, 78, 90),
            new Mahasiswa("2024002", "Budi Santoso", 60, 55, 62),
            new Mahasiswa("2024003", "Citra Wijaya", 92, 88, 95)
        };
        for (Mahasiswa m : kelas) {
            System.out.println("  " + m);
        }

        System.out.println();
        System.out.println("=== Objek menolak data yang melanggar aturan ===");
    }
}
        