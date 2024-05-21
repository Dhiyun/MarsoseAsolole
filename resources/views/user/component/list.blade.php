<style>
    ul {
        list-style: none;
        padding-left: 0;
    }

    a {
        text-decoration: none;
    }

    /* unvisited link */
    .one:link {
        color: grey;
    }

    /* visited link */
    .one:visited {
        color: grey;
    }

    /* mouse over link */
    .one:hover {
        text-decoration: none !important;
        font-weight: bold !important;
        cursor: pointer !important;
        color: black;
    }

    /* selected link */
    .one:active {
        color: black;
        font-weight: bold;
    }

    .menu-list a.active {
        color: #000;
        font-weight: bold;
    }

    ul li {
        margin-bottom: 15px;
    }

    html {
	    scroll-behavior: smooth;
    }
</style>

<div id="v-pills-tab" role="tablist" aria-orientation="vertical" class="mCustomScrollbar _mCS_1 mCS-autoHide menu-list" style="margin-top: -30px;">
    <ul style="margin-left: -35px; margin-top: 45px; font-size: 15px;">
        <li>
            <a class="one surat_keterangan" data-toggle="pills" href="/user/surat_keterangan?#v-pills-tabContent" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <span>Surat Keterangan</span>
            </a>
        </li>
        <li>
            <a class="one surat_pengantar" data-toggle="pills" href="/user/surat_pengantar?#v-pills-tabContent" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <span>Surat Pengantar</span>
            </a>
        </li>
        <li>
            <a class="one surat_pemberitahuan" data-toggle="pills" href="/user/surat_pemberitahuan?#v-pills-tabContent" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <span>Surat Pemberitahuan</span>
            </a>
        </li>
        <li>
            <a class="one surat_undangan" data-toggle="pills" href="/user/surat_undangan?#v-pills-tabContent" role="tab" aria-controls="v-pills-1" aria-selected="false">
                <span>Surat Undangan</span>
            </a>
        </li>
    </ul>
</div>