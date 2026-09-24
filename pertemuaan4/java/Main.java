public class Main {
    public static void main(String[] args) {

        Pegawai[] daftar = {
            new PegawaiTetap("198701012010", "Ani Lestari", 6_000_000, 15),
            new PegawaiKontrak("K-2024-007", "Budi Santoso", 5_000_000, 12),
            new Dosen2("200201012015", "Citra Dewi", 4_500_000, 8),
            new Pegawaiharian("H-2024-001", "Dedi Pratama", 100_000, 20)
        };

        // Daftar gaji (polimorfisme: tiap objek memakai hitungGaji() miliknya sendiri)
        System.out.println("=== Daftar Gaji ===");
        for (Pegawai p : daftar) {
            System.out.println("  " + p);
        }

        // Total beban gaji
        double total = 0;
        for (Pegawai p : daftar) {
            total += p.hitungGaji();
        }
        System.out.printf("%n  Total beban gaji: Rp%,.2f%n", total);

        // Pemeriksaan hasil
        System.out.println();
        System.out.println("=== Pemeriksaan ===");
        periksa("Ani (6.000.000 + 15 x 2%)", daftar[0].hitungGaji(), 7_800_000);
        periksa("Citra (4.500.000 + 8 SKS x 50.000)", daftar[2].hitungGaji(), 4_900_000);
    }

    private static void periksa(String keterangan, double hasil, double harapan) {
        String status = (hasil == harapan) ? "OK   " : "SALAH";
        System.out.printf("  [%s] %-38s hasil Rp%,.2f | seharusnya Rp%,.2f%n",
                status, keterangan, hasil, harapan);
    }
}