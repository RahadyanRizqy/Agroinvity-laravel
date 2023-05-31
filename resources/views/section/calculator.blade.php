<main>
    <section class="report">
        <div class="row g-0">
            <div class="col-md-6 g-0">
                <h1 class="title mb-2">Kalkulator</h1>
                <form action="{{ route('section.calcresult')}}" method="POST">
                    @csrf
                    <div class="date-group mb-3">
                        <label for="datepicker">Pilih Tanggal Awal:</label>
                        <input type="text" size="16" style="text-align:center;" id="datepicker1" name="from" value="{{ $from ?? '' }}"readonly>
                        <script>
                            $(document).ready(function () {
                                var userLang = navigator.language || navigator.userLanguage;

                                var options = $.extend({},
                                    $.datepicker.regional["en"], {
                                    dateFormat: "dd MM yy",
                                    }
                                );

                                $("#datepicker1").datepicker(options);
                            });
                        </script>
                    </div>
                    <div class="date-group mb-3">
                        <label for="datepicker">Pilih Tanggal Akhir:</label>
                        <input type="text" size="16" style="text-align:center;" id="datepicker2" name="to" value="{{ $to ?? '' }}" readonly>
                        <script>
                            $(document).ready(function () {
                                var userLang = navigator.language || navigator.userLanguage;

                                var options = $.extend({},
                                    $.datepicker.regional["en"], {
                                    dateFormat: "dd MM yy",
                                    }
                                );

                                $("#datepicker2").datepicker(options);
                            });
                        </script>
                    </div>
                    <div class="btn-group d-flex col-md-3 flex-column">
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="operational">Hitung Biaya Operasional</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="material">Hitung Biaya Bahan Baku</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="product">Hitung Pemasukan Produk</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="omzet">Hitung Omzet</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="loss">Hitung Kerugian</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary mb-3" type="submit" name="action" value="profit">Hitung Keuntungan</button>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-danger mb-3" type="submit" name="action" value="delete">Hapus History</button>
                        </div>
                    </div>
                    {{-- <button id="showReportButton" class="btn btn-primary">Tampilkan</button> --}}
                </form>
                {{-- <a href="#" class="btn btn-danger mt-3">Cetak PDF <i class="fa fa-file-pdf-o"></i></a> --}}
                <script>
                    $(document).ready(function() {
                        $("#showReportButton").click(function() {
                            var fromDate = $("#datepicker1").val();
                            var toDate = $("#datepicker2").val();

                            $.ajax({
                            url: "{{ route('section.reportresults') }}",
                            type: "POST",
                            data: {
                                from: fromDate,
                                to: toDate
                            },
                            success: function(response) {
                                // Update the content with the received response
                                $(".content-data").html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log("An error occurred:", error);
                            }
                            });
                        });
                        });

                </script>


            </div>
            <div class="col-md-6 g-0">
                <textarea name="" id="" cols="60" rows="20" style="font-size: 15pt; text-align: left;" readonly>@foreach($calc as $c){{$c['histories'] . " [::] " . $c['stored_at']. "\n" }}@endforeach
                </textarea>
            </div>
        </div>
    </section>
</main>`