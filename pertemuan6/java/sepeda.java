public class sepeda extends Kendaraan implements Movable {
    private final int jumlahRoda;

    public sepeda(String merek, int tahun, int jumlahRoda) {
        super(merek, tahun);
        this.jumlahRoda = jumlahRoda;
    }

    @Override
    public void bergerak() {
        System.out.println("Sepeda bergerak dengan mengayuh pedal.");
    }

    @Override
    public double kecepatanMaksimum() {
        return 25.0; // Kecepatan maksimum sepeda dalam km/jam
    }

    @Override
    public int jumlahRoda() {
        return jumlahRoda;
    }
    
}
