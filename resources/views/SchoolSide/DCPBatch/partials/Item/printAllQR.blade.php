  <div id="print-qr-section" style="display:none;">
      <div style="width:210mm;min-height:297mm;padding:0;margin:0;">
          <h2 style="text-align:center;font-size:24px;margin:16px 0;">Batch Items QR Codes</h2>
          <div
              style="
                        display: grid;
                        grid-template-columns: repeat(5, 1fr);
                        gap: 0;
                        width: 140%;
                        margin: 0;
                        padding: 0;">
              @foreach ($items as $item)
                  <div style="padding:0;box-sizing:border-box;page-break-inside:avoid;">
                      <div style="border:1px solid #ccc;padding:10px;text-align:center;">
                          <div>
                              @php
                                  $url = url("/School/DCPInventory/{$item->generated_code}");
                                  $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                      ->size(120)
                                      ->generate($url);
                              @endphp
                              {!! $svg !!}
                          </div>
                          <div style="font-size:14px;margin-top:8px;">
                              <b>{{ $item->generated_code }}</b><br>

                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
