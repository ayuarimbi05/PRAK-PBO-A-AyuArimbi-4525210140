public class AntiPatternRefaktor {
    public static void main(String[] args) {
        BangunDatar[] daftar = {
            new Lingkaran(7),
            new Persegi(5),
            new segitiga(1,2,3),
            new Trapesium(6, 10, 4),
        };

        System.out.println("=== Bangun Datar ===");
        for (BangunDatar bangun : daftar) {
            System.out.printf("%s: luas=%.2f, keliling=%.2f%n",
                    bangun.getNama(), bangun.luas(), bangun.keliling());
        }
    }
    
}
