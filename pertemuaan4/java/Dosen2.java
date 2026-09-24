public class Dosen2 extends Pegawai {
    private final int jumlahSKS;

    public Dosen2(String nip, String nama, double gajiPokok, int jumlahSKS) {
        super(nip, nama, gajiPokok);
        this.jumlahSKS = jumlahSKS;
    }

    @Override
    public double hitungGaji() {
        return gajiPokok + (jumlahSKS * 50_000);
    }

    @Override
    public String jenis() {
        return "DOSEN";
    }

    public int getJumlahSKS() {
        return jumlahSKS;
    }
}