    <!--==========================================START FOOTER ==========================================-->
        <footer>
            <img src="<?= BASEURL ;?>/assets/img/logo2.png" alt="logo" />
            <div class="link">
                <h3>Kontak Kami</h3>
                <a href="mailto:220411100082@student.trunojoyo.ac.id">
                    plantifygarden@gmail.com
                </a>
                <a href="https://wa.me/6281216505560">
                    +62 812-1650-5560
                </a>
                <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.9644736773307!2d112.72410727433831!3d-7.130106192873798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd803dcd1e1bd7f%3A0x5261304f608c91db!2sLey%20Denara!5e0!3m2!1sid!2sid!4v1699597392448!5m2!1sid!2sid">
                    Universitas Trunojoyo Madura, Telang, Kec. Kamal, Kabupaten Bangkalan, Jawa Timur 
                </a>
            </div>
            <div class="link">
                <h3>Link</h3>     <!--Jika ada title yang sama maka dikasih class active-->
                <a class="<?= $title == 'Beranda' ? 'active' : '' ?>" href="<?= BASEURL. "/customer/index.php" ?>">Beranda</a>
                <a class="<?= $title == 'Produk' ? 'active' : '' ?>" href="<?= BASEURL. "/customer/produk.php" ?>">Produk</a>
                <a class="<?= $title == 'Daftar Pesanan' ? 'active' : '' ?>" href="<?= BASEURL. "/customer/daftar_transaksi.php" ?>">Daftar Pesanan</a>
            </div>
        </footer>
    <div class="copyright">
      <h5>Copyright&copy;2023 PAW2023-1-E04</h5>
    </div>
    <!--============================================ END FOOTER ==========================================-->
</body>
</html>