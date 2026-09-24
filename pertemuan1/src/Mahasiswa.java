

    public class Mahasiswa {
    // Konstanta bobot — jangan menulis angka 0.30 dan 0.40 di dalam method.
    public static final double BOBOT_TUGAS = 0.30;
    public static final double BOBOT_UTS   = 0.30;
    public static final double BOBOT_UAS   = 0.40;

    private static final double NILAI_MIN = 0;
    private static final double NILAI_MAX = 100;

    // TODO 1: deklarasikan atribut. Perhatikan mana yang boleh berubah
    //         dan mana yang tidak. Gunakan final untuk yang tidak boleh berubah.
    private final String nim;
    private final String nama;
    private double nilaiTugas;
    private double nilaiUts;
    private double nilaiUas;

    public Mahasiswa(String nim, String nama, double nilaiTugas, double nilaiUts, double nilaiUas) {
        this.nim = nim;
        this.nama = nama;
        this.nilaiTugas = nilaiTugas;
        this.nilaiUts = nilaiUts;
        this.nilaiUas = nilaiUas;
    }

    /**
     * TODO 5: hitung nilai akhir memakai konstanta bobot di atas.
     */
    public double nilaiAkhir() {
        return (nilaiTugas * BOBOT_TUGAS) + (nilaiUts * BOBOT_UTS) + (nilaiUas * BOBOT_UAS);
    }

    /**
     * TODO 6: kembalikan huruf mutu berdasarkan nilai akhir.
     *   >= 80 -> "A"   >= 70 -> "B"   >= 60 -> "C"   >= 50 -> "D"   selain itu "E"
     */
    public String hurufMutu() {
        double nilaiAkhir = nilaiAkhir();
        if (nilaiAkhir >= 80) return "A";
        if (nilaiAkhir >= 70) return "B";
        if (nilaiAkhir >= 60) return "C";
        if (nilaiAkhir >= 50) return "D";
        return "E";
    }

    // ── Getter ────────────────────────────────────────────────
    // TODO 7: sediakan getter untuk nim, nama, dan nilaiAkhir.
    //         JANGAN membuat setNim(). Baca ulang invariant Anda kalau tergoda.
    public String getNim() { return nim; }
    public String getNama() { return nama; }
    public double getNilaiAkhir() { return nilaiAkhir(); }

    @Override
    public String toString() {
        return String.format("%-10s %-18s akhir=%6.2f  mutu=%s",
                nim, nama, nilaiAkhir(), hurufMutu());
    }
}
