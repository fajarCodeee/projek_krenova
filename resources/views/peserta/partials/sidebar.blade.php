<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('peserta.dashboard') }}">
            <div class="parent-icon"><i class='bx bx-home'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="">
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-spa'></i>
            </div>
            <div class="menu-title">Krenova</div>
        </a>
        <ul>
            <li>
                <a href="#"><i class="bx bx-right-arrow-alt"></i>Daftar
                    Inovasi</a>
            </li>
            <li class="{{ Route::is('peserta.krenova.create.daftar-inovasi') ? 'mm-active' : '' }}"> <a
                    href="{{ route('peserta.krenova.daftar-inovasi') }}"><i class="bx bx-right-arrow-alt"></i>Menunggu
                    Verifikasi</a>
            </li>
            <li class="{{ Route::is('peserta.krenova.edit.daftar-inovasi') ? 'mm-active' : '' }}"> <a
                    href="{{ route('peserta.krenova.daftar-draft-inovasi') }}"><i
                        class="bx bx-right-arrow-alt"></i>Draft</a>
            </li>
        </ul>
    </li>
    </li>
    <li class="">
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-blanket'></i>
            </div>
            <div class="menu-title">Penelitian Daerah</div>
        </a>
        <ul>
            <li>
                <a href="#"><i class="bx bx-right-arrow-alt"></i>Daftar
                    Penelitian</a>
            </li>
            <li>
                <a href="{{ route('peserta.penelitian.daftar-penelitian-daerah') }}"><i
                        class="bx bx-right-arrow-alt"></i>Menunggu Verifikasi</a>
            </li>
            <li>
                <a href="#"><i class="bx bx-right-arrow-alt"></i>Draft</a>
            </li>
        </ul>
    </li>
</ul>
