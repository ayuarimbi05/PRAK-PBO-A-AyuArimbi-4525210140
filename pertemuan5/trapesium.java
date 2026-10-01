class Trapesium extends BangunDatar {
    private final double sisiAtas;
    private final double sisiBawah;
    private final double tinggi;

    public Trapesium(double sisiAtas, double sisiBawah, double tinggi) {
        super("Trapesium");
        this.sisiAtas = sisiAtas;
        this.sisiBawah = sisiBawah;
        this.tinggi = tinggi;
    }

    @Override
    public double luas() {
        return 0.5 * (sisiAtas + sisiBawah) * tinggi;
    }

    @Override
    public double keliling() {
        double setengahSelisih = Math.abs(sisiBawah - sisiAtas) / 2.0;
        double sisiMiring = Math.sqrt(
                (setengahSelisih * setengahSelisih) + (tinggi * tinggi));
        return sisiAtas + sisiBawah + (2.0 * sisiMiring);
    }

    @Override
    public String getNama() {
        return "Trapesium";
    }
}
