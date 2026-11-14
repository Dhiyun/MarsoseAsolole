<footer class="footer-warga">
    <div class="container">
        <div class="footer-warga-atas">
            <div class="footer-warga-brand">
                <img src="{{ asset('assets/img/Marsose Fix (Light).svg') }}" alt="Marsose" class="footer-warga-logo">
                <p>Tempat warga RW 03 Kelurahan Kesatrian, Kecamatan Blimbing, Kota Malang menyampaikan keluhan dan mengurus surat.</p>
            </div>
            <nav class="footer-warga-menu">
                <a href="{{ route('user.index') }}">Dashboard</a>
                <a href="{{ route('user-laporan.index') }}">Laporan Warga</a>
                <a href="{{ route('user.surat_keterangan') }}">Surat-surat</a>
                <a href="{{ route('profile-user') }}">Profil Saya</a>
            </nav>
        </div>
        <div class="footer-warga-bawah">
            <span>&copy; {{ date('Y') }} Marsose. Semua hak dilindungi.</span>
            <span>Dibuat oleh Kelompok 2 | TI-2B</span>
        </div>
    </div>
</footer>
