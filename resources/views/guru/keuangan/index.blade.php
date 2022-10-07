<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <form method="GET">
        <div class="uk-margin">
            <input type="date" name="dari" value="{{ request('dari') }}">
            <input type="date" name="sampai" value="{{ request('sampai') }}">
            <p class="uk-margin">
                <button class="uk-button uk-button-primary uk-button-small" type="submit">SHOW</button>
            </p>
        </div>
    </form>

    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th>Guru</th>
                <th>Jml Jam (/Week)</th>
                <th>Tertunaikan</th>
                <th>Transport</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
        </thead>
        @foreach ($dataJadwal as $showJadwal)                
        <tbody>
            <tr>
                <td>{{ $showJadwal->nama_guru }}</td>
                <td>{{ ceil($showJadwal->jumlah_jam) }}</td>
                <td>
                    @php
                        $dataTertunaikan = DB::table('jurnal')
                                            ->crossJoin('jadwal')
                                            ->select('jadwal.guru_id', DB::raw('SUM(jurnal.lama) as tertunaikan'))
                                            ->where('jadwal.guru_id', $showJadwal->id_guru)
                                            ->where('jurnal.jadwal_id', '=', DB::raw('jadwal.id_jadwal'))
                                            ->where('jurnal.tanggal', '>=', request('dari'))
                                            ->where('jurnal.tanggal', '<=', request('sampai'))
                                            ->groupBy('jurnal.jadwal_id')
                                            ->get();
                        if (count($dataTertunaikan) > 0){
                            echo $dataTertunaikan[0]->tertunaikan;
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp
                </td>
                <td>
                    @php
                        $dataTransport = DB::table('jurnal')
                                            ->crossJoin('jadwal')
                                            ->select('jadwal.guru_id', DB::raw('SUM(jurnal.lama) as transport'))
                                            ->where('jadwal.guru_id', $showJadwal->id_guru)
                                            ->where('jurnal.jadwal_id','=',DB::raw('jadwal.id_jadwal'))
                                            ->where('jurnal.transport', '=', 1)
                                            ->where('jurnal.tanggal', '>=', request('dari'))
                                            ->where('jurnal.tanggal', '<=', request('sampai'))
                                            ->groupBy('jurnal.jadwal_id')
                                            ->get();
                        if (count($dataTransport) > 0){
                            echo $dataTransport[0]->transport;
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp
                </td>
                <td>
                    @php
                        $dataSakit = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as sakit'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'S')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataSakit) > 0){
                            echo ceil($dataSakit[0]->sakit);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
                <td>
                    @php
                        $dataIzin = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as izin'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'I')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataIzin) > 0){
                            echo ceil($dataIzin[0]->izin);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
                <td>
                    @php
                        $dataAlfa = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as alfa'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'A')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataAlfa) > 0){
                            echo ceil($dataAlfa[0]->alfa);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</x-admintemplate>