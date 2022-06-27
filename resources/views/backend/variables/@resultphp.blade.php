//Data Variabel
        foreach ($variables as $key=> $variable){
            $variable->softskill;
            $variable->hardskill;
        }
        //Fuzzifikasi
        foreach ($variables as $key=> $variable){
            //softskill_kurang
                if ($variable->softskill<=$set_kurang->left_down || $variable->softskill>=$set_kurang->right_down){
                    $softskill_kurang = number_format(0, 2, '.', '');
                }elseif($set_kurang->left_down<=$variable->softskill && $variable->softskill<=$set_kurang->left_up){
                    $softskill_kurang = number_format(($variable->softskill-$set_kurang->left_down)/($set_kurang->left_up-$set_kurang->left_down), 2, '.', '');
                }elseif($set_kurang->left_up<=$variable->softskill && $variable->softskill<=$set_kurang->right_up){
                    $softskill_kurang = number_format(1, 2, '.', '');
                }elseif($set_kurang->right_up<=$variable->softskill && $variable->softskill<=$set_kurang->right_down){
                    $softskill_kurang = number_format(($set_kurang->right_down-$variable->softskill)/($set_kurang->right_down-$set_kurang->right_up), 2, '.', '');
                }
            //softskill_cukup
                if ($variable->softskill<=$set_cukup->left_down || $variable->softskill>=$set_cukup->right_down){
                    $softskill_cukup = number_format(0, 2, '.', '');
                }elseif($set_cukup->left_down<=$variable->softskill && $variable->softskill<=$set_cukup->left_up){
                    $softskill_cukup = number_format(($variable->softskill-$set_cukup->left_down)/($set_cukup->left_up-$set_cukup->left_down), 2, '.', '');
                }elseif($set_cukup->left_up<=$variable->softskill && $variable->softskill<=$set_cukup->right_up){
                    $softskill_cukup = number_format(1, 2, '.', '');
                }elseif($set_cukup->right_up<=$variable->softskill && $variable->softskill<=$set_cukup->right_down){
                    $softskill_cukup = number_format(($set_cukup->right_down-$variable->softskill)/($set_cukup->right_down-$set_cukup->right_up), 2, '.', '');
                }
            //softskill_baik
                if ($variable->softskill<=$set_baik->left_down || $variable->softskill>=$set_baik->right_down){
                    $softskill_baik = number_format(0, 2, '.', '');
                }elseif($set_baik->left_down<=$variable->softskill && $variable->softskill<=$set_baik->left_up){
                    $softskill_baik = number_format(($variable->softskill-$set_baik->left_down)/($set_baik->left_up-$set_baik->left_down), 2, '.', '');
                }elseif($set_baik->left_up<=$variable->softskill && $variable->softskill<=$set_baik->right_up){
                    $softskill_baik = number_format(1, 2, '.', '');
                }elseif($set_baik->right_up<=$variable->softskill && $variable->softskill<=$set_baik->right_down){
                    $softskill_baik = number_format(($set_baik->right_down-$variable->softskill)/($set_baik->right_down-$set_baik->right_up), 2, '.', '');
                }
            //hardskill_kurang
                if ($variable->hardskill<=$set_kurang->left_down || $variable->hardskill>=$set_kurang->right_down){
                    $hardskill_kurang = number_format(0, 2, '.', '');
                }elseif($set_kurang->left_down<=$variable->hardskill && $variable->hardskill<=$set_kurang->left_up){
                    $hardskill_kurang = number_format(($variable->hardskill-$set_kurang->left_down)/($set_kurang->left_up-$set_kurang->left_down), 2, '.', '');
                }elseif($set_kurang->left_up<=$variable->hardskill && $variable->hardskill<=$set_kurang->right_up){
                    $hardskill_kurang = number_format(1, 2, '.', '');
                }elseif($set_kurang->right_up<=$variable->hardskill && $variable->hardskill<=$set_kurang->right_down){
                    $hardskill_kurang = number_format(($set_kurang->right_down-$variable->hardskill)/($set_kurang->right_down-$set_kurang->right_up), 2, '.', '');
                }
            //hardskill_cukup
                if ($variable->hardskill<=$set_cukup->left_down || $variable->hardskill>=$set_cukup->right_down){
                    $hardskill_cukup = number_format(0, 2, '.', '');
                }elseif($set_cukup->left_down<=$variable->hardskill && $variable->hardskill<=$set_cukup->left_up){
                    $hardskill_cukup = number_format(($variable->hardskill-$set_cukup->left_down)/($set_cukup->left_up-$set_cukup->left_down), 2, '.', '');
                }elseif($set_cukup->left_up<=$variable->hardskill && $variable->hardskill<=$set_cukup->right_up){
                    $hardskill_cukup = number_format(1, 2, '.', '');
                }elseif($set_cukup->right_up<=$variable->hardskill && $variable->hardskill<=$set_cukup->right_down){
                    $hardskill_cukup = number_format(($set_cukup->right_down-$variable->hardskill)/($set_cukup->right_down-$set_cukup->right_up), 2, '.', '');
                }
            //hardskill_baik
                if ($variable->hardskill<=$set_baik->left_down || $variable->hardskill>=$set_baik->right_down){
                    $hardskill_baik = number_format(0, 2, '.', '');
                }elseif($set_baik->left_down<=$variable->hardskill && $variable->hardskill<=$set_baik->left_up){
                    $hardskill_baik = number_format(($variable->hardskill-$set_baik->left_down)/($set_baik->left_up-$set_baik->left_down), 2, '.', '');
                }elseif($set_baik->left_up<=$variable->hardskill && $variable->hardskill<=$set_baik->right_up){
                    $hardskill_baik = number_format(1, 2, '.', '');
                }elseif($set_baik->right_up<=$variable->hardskill && $variable->hardskill<=$set_baik->right_down){
                    $hardskill_baik = number_format(($set_baik->right_down-$variable->hardskill)/($set_baik->right_down-$set_baik->right_up), 2, '.', '');
                }
        }
        //Alpha Predikat
        $alpha_satu = min($softskill_kurang,$hardskill_kurang);
        $alpha_dua = min($softskill_kurang,$hardskill_cukup);
        $alpha_tiga = min($softskill_kurang,$hardskill_baik);
        $alpha_empat = min($softskill_kurang,$hardskill_cukup);
        $alpha_lima = min($softskill_cukup,$hardskill_cukup);
        $alpha_enam = min($softskill_cukup,$hardskill_baik);
        $alpha_tujuh = min($softskill_baik,$hardskill_kurang);
        $alpha_delapan = min($softskill_baik,$hardskill_cukup);
        $alpha_sembilan = min($softskill_baik,$hardskill_baik);

        dd($alpha_satu);
        //Z rule
        // foreach ($variables as $key=> $variable){
        //     foreach ($rules as $key => $rule){
        //         $rule->performance;
        //     }
        // }

        $sum_alpha = $alpha_satu+$alpha_dua+$alpha_tiga+$alpha_empat+$alpha_lima+$alpha_enam+$alpha_tujuh+$alpha_delapan+$alpha_sembilan;

        $sum_alpha_z = $alpha_satu*$z_satu['performance']+$alpha_dua*$z_dua['performance']+$alpha_tiga*$z_tiga['performance']+$alpha_empat*$z_empat['performance']+$alpha_lima*$z_lima['performance']+$alpha_enam*$z_enam['performance']+$alpha_tujuh*$z_tujuh['performance']+$alpha_delapan*$z_delapan['performance']+$alpha_sembilan*$z_sembilan['performance'];

        //Defuzzifikasi
        $nilai_z = number_format($sum_alpha_z/$sum_alpha, 2, '.', '');
        // dd($nilai_z);

        $result = Result::where('questionnaire_id', $questionnaire)->get();
        // dd($questionnaire);

        if (empty(count($result))) {

            $questionnaire->result()->create([
                'sum_alpha' => $sum_alpha,
                'sum_alpha_z' => $sum_alpha_z,
                'performance' => $nilai_z,
            ]);
        }

        $questionnaire->result()->update([
            'sum_alpha' => $sum_alpha,
            'sum_alpha_z' => $sum_alpha_z,
            'performance' => $nilai_z,
        ]);

        Alert::toast('Perhitungan Kuesioner Periode Berhasil', 'success');


                        {{-- Data Variabel --}}
                        @foreach ($variables as $key=> $variable)
                            {{ $variable->softskill }}
                            {{ $variable->hardskill }}
                        @endforeach
                        {{-- Fuzzifikasi --}}
                        @foreach ($variables as $key=> $variable)
                            {{-- softskill_kurang --}}
                                @if ($variable->softskill<=$set_kurang->left_down || $variable->softskill>=$set_kurang->right_down)
                                <td>{{ $softskill_kurang = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_kurang->left_down<=$variable->softskill && $variable->softskill<=$set_kurang->left_up)
                                <td>{{ $softskill_kurang = number_format(($variable->softskill-$set_kurang->left_down)/($set_kurang->left_up-$set_kurang->left_down), 2, '.', '')}}</td>
                                @elseif($set_kurang->left_up<=$variable->softskill && $variable->softskill<=$set_kurang->right_up)
                                <td>{{ $softskill_kurang = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_kurang->right_up<=$variable->softskill && $variable->softskill<=$set_kurang->right_down)
                                <td>{{ $softskill_kurang = number_format(($set_kurang->right_down-$variable->softskill)/($set_kurang->right_down-$set_kurang->right_up), 2, '.', '')}}</td>
                                @endif
                            {{-- softskill_cukup --}}
                                @if ($variable->softskill<=$set_cukup->left_down || $variable->softskill>=$set_cukup->right_down)
                                <td>{{ $softskill_cukup = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_cukup->left_down<=$variable->softskill && $variable->softskill<=$set_cukup->left_up)
                                <td>{{ $softskill_cukup = number_format(($variable->softskill-$set_cukup->left_down)/($set_cukup->left_up-$set_cukup->left_down), 2, '.', '')}}</td>
                                @elseif($set_cukup->left_up<=$variable->softskill && $variable->softskill<=$set_cukup->right_up)
                                <td>{{ $softskill_cukup = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_cukup->right_up<=$variable->softskill && $variable->softskill<=$set_cukup->right_down)
                                <td>{{ $softskill_cukup = number_format(($set_cukup->right_down-$variable->softskill)/($set_cukup->right_down-$set_cukup->right_up), 2, '.', '')}}</td>
                                @endif
                            {{-- softskill_baik --}}
                                @if ($variable->softskill<=$set_baik->left_down || $variable->softskill>=$set_baik->right_down)
                                <td>{{ $softskill_baik = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_baik->left_down<=$variable->softskill && $variable->softskill<=$set_baik->left_up)
                                <td>{{ $softskill_baik = number_format(($variable->softskill-$set_baik->left_down)/($set_baik->left_up-$set_baik->left_down), 2, '.', '')}}</td>
                                @elseif($set_baik->left_up<=$variable->softskill && $variable->softskill<=$set_baik->right_up)
                                <td>{{ $softskill_baik = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_baik->right_up<=$variable->softskill && $variable->softskill<=$set_baik->right_down)
                                <td>{{ $softskill_baik = number_format(($set_baik->right_down-$variable->softskill)/($set_baik->right_down-$set_baik->right_up), 2, '.', '')}}</td>
                                @endif
                            {{-- hardskill_kurang --}}
                                @if ($variable->hardskill<=$set_kurang->left_down || $variable->hardskill>=$set_kurang->right_down)
                                <td>{{ $hardskill_kurang = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_kurang->left_down<=$variable->hardskill && $variable->hardskill<=$set_kurang->left_up)
                                <td>{{ $hardskill_kurang = number_format(($variable->hardskill-$set_kurang->left_down)/($set_kurang->left_up-$set_kurang->left_down), 2, '.', '')}}</td>
                                @elseif($set_kurang->left_up<=$variable->hardskill && $variable->hardskill<=$set_kurang->right_up)
                                <td>{{ $hardskill_kurang = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_kurang->right_up<=$variable->hardskill && $variable->hardskill<=$set_kurang->right_down)
                                <td>{{ $hardskill_kurang = number_format(($set_kurang->right_down-$variable->hardskill)/($set_kurang->right_down-$set_kurang->right_up), 2, '.', '')}}</td>
                                @endif
                            {{-- hardskill_cukup --}}
                                @if ($variable->hardskill<=$set_cukup->left_down || $variable->hardskill>=$set_cukup->right_down)
                                <td>{{ $hardskill_cukup = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_cukup->left_down<=$variable->hardskill && $variable->hardskill<=$set_cukup->left_up)
                                <td>{{ $hardskill_cukup = number_format(($variable->hardskill-$set_cukup->left_down)/($set_cukup->left_up-$set_cukup->left_down), 2, '.', '')}}</td>
                                @elseif($set_cukup->left_up<=$variable->hardskill && $variable->hardskill<=$set_cukup->right_up)
                                <td>{{ $hardskill_cukup = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_cukup->right_up<=$variable->hardskill && $variable->hardskill<=$set_cukup->right_down)
                                <td>{{ $hardskill_cukup = number_format(($set_cukup->right_down-$variable->hardskill)/($set_cukup->right_down-$set_cukup->right_up), 2, '.', '')}}</td>
                                @endif
                            {{-- hardskill_baik --}}
                                @if ($variable->hardskill<=$set_baik->left_down || $variable->hardskill>=$set_baik->right_down)
                                <td>{{ $hardskill_baik = number_format(0, 2, '.', '')}}</td>
                                @elseif($set_baik->left_down<=$variable->hardskill && $variable->hardskill<=$set_baik->left_up)
                                <td>{{ $hardskill_baik = number_format(($variable->hardskill-$set_baik->left_down)/($set_baik->left_up-$set_baik->left_down), 2, '.', '')}}</td>
                                @elseif($set_baik->left_up<=$variable->hardskill && $variable->hardskill<=$set_baik->right_up)
                                <td>{{ $hardskill_baik = number_format(1, 2, '.', '')}}</td>
                                @elseif($set_baik->right_up<=$variable->hardskill && $variable->hardskill<=$set_baik->right_down)
                                <td>{{ $hardskill_baik = number_format(($set_baik->right_down-$variable->hardskill)/($set_baik->right_down-$set_baik->right_up), 2, '.', '')}}</td>
                                @endif
                        @endforeach
                        {{-- Alpha Predikat --}}
                        @foreach ($variables as $key=> $variable)
                            <td>{{ $alpha_satu = min($softskill_kurang,$hardskill_kurang) }}</td>
                            <td>{{ $alpha_dua = min($softskill_kurang,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_tiga = min($softskill_kurang,$hardskill_baik) }}</td>
                            <td>{{ $alpha_empat = min($softskill_kurang,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_lima = min($softskill_cukup,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_enam = min($softskill_cukup,$hardskill_baik) }}</td>
                            <td>{{ $alpha_tujuh = min($softskill_baik,$hardskill_kurang) }}</td>
                            <td>{{ $alpha_delapan = min($softskill_baik,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_sembilan = min($softskill_baik,$hardskill_baik) }}</td>
                        @endforeach
                        {{-- Z rule --}}
                        @foreach ($variables as $key=> $variable)
                            @foreach ($rules as $key => $rule)
                            <td>{{ $rule->performance  }}</td>
                            @endforeach
                        @endforeach
                        {{-- Defuzzifikasi --}}
                        @foreach ($variables as $key=> $variable)
                            <td>{{ ($alpha_satu*$z_satu['performance']+$alpha_dua*$z_dua['performance']+$alpha_tiga*$z_tiga['performance']+$alpha_empat*$z_empat['performance']+$alpha_lima*$z_lima['performance']+$alpha_enam*$z_enam['performance']+$alpha_tujuh*$z_tujuh['performance']+$alpha_delapan*$z_delapan['performance']+$alpha_sembilan*$z_sembilan['performance'])/($alpha_satu+$alpha_dua+$alpha_tiga+$alpha_empat+$alpha_lima+$alpha_enam+$alpha_tujuh+$alpha_delapan+$alpha_sembilan) }}</td>
                        @endforeach

