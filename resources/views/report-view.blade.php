@extends('partial.main')
@section('title', 'Report')

@section('content')


<section class="section">
  
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filter</h5>

            <form action="/generate-report/{{$submitType}}" method="POST" class="row g-3">
              @csrf
              <div class="col-md-3">
                <label class="form-label">From</label>
                <input type="date" class="form-control" name="start_date" required>
              </div>
              <div class="col-md-3">
                <label class="form-label">To</label>
                <input type="date" class="form-control" name="end_date" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Select data</label>
                <select id="e7" class="form-select group-by-select" multiple>
                  @php
                      $allLabels = []; // Create an array to store unique labels
                  @endphp
                  @foreach ($submittedAll as $item)
                      @php
                          $fields = json_decode($item->fields, true);
                      @endphp
                      @foreach ($fields as $field)
                        @if (!in_array($field['label'], $allLabels)) {{-- Check if the label is not already in the array --}}
                          <option value="{{ $field['label'] }}">{{ $field['label'] }}</option>
                          @php
                              $allLabels[] = $field['label']; // Add the label to the array to track uniqueness
                          @endphp
                        @endif
                      @endforeach
                  @endforeach
                </select>
                <input type="hidden" id="selectedValuesData" name="group_by">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Generate</button>
                @if ($submitType == "INTAKE & CONSENT FORM")
                <button type="submit" class="btn btn-info">Preset Report</button>
                @endif
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#verticalycenteredreport">
                  Export to PDF
                </button>
                <div class="modal fade" id="verticalycenteredreport" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body card-exportReportPDF">
                        <div class="text-center">
                        <img src="{{asset('images/Artboard-5.png')}}" alt="" class="img-fluid" width="200px" height="300px">
                        <h2>{{$submitType}} Report</h2> <br>
                        <p>From {{$startdate}} to {{$enddate}}</p> <br>
                        </div>
                        <div class="row text-center">
                        @if ($chartsData !== null)
                        @foreach ($chartsData as $index => $item)
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == $item['chartLabels']) {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        if (is_array($race)) {
                                            // Handle array values (e.g., checkboxes)
                                            foreach ($race as $checkboxValue) {
                                                // Increment the count for each checkbox value
                                                $raceCounts[$checkboxValue] = ($raceCounts[$checkboxValue] ?? 0) + 1;
                                            }
                                        } else {
                                            // Handle string values
                                            $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                        }
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-12">
                        <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{$item['chartLabels']}}</h5>
                        
                          <!-- Pie Chart -->
                          @php
                              $sanitizedLabelc = preg_replace('/[^a-zA-Z0-9-_]/', '_', $item['chartLabels']);
                          @endphp
                          <div id="{{$sanitizedLabelc}}-c"></div>
                        
                          <script>
                              const seriesDatac_{{$index}} = {!! json_encode(array_values($raceCounts)) !!};
                              const labelc_{{$index}} = {!! json_encode(array_keys($raceCounts)) !!};
                          
                              document.addEventListener("DOMContentLoaded", () => {
                                  new ApexCharts(document.querySelector("#{{$sanitizedLabelc}}-c"), {
                                      series: seriesDatac_{{$index}},
                                      chart: {
                                          height: 350,
                                          type: 'pie',
                                          toolbar: {
                                              show: true
                                          }
                                      },
                                      labels: labelc_{{$index}}
                                  }).render();
                              });
                          </script>
                          
                          <!-- End Pie Chart -->
                        
                        </div>
                        </div>
                        </div>
                        @endforeach
                        @else
                        <!-- Preset Report Number 1 -------------------------------------------------------------->
                        @php
                        $ageCounts = [
                            '10-20' => 0,
                            '20-30' => 0,
                            '30-40' => 0,
                            '40-50' => 0,
                            '50++' => 0,
                        ];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Age") {
                                        $age = (int)$field['value'];
                                        // Determine the age range and increment the count in $ageCounts
                                        if ($age >= 10 && $age < 20) {
                                            $ageCounts['10-20']++;
                                        } elseif ($age >= 20 && $age < 30) {
                                            $ageCounts['20-30']++;
                                        } elseif ($age >= 30 && $age < 40) {
                                            $ageCounts['30-40']++;
                                        } elseif ($age >= 40 && $age < 50) {
                                            $ageCounts['40-50']++;
                                        } else {
                                            $ageCounts['50++']++;
                                        }
                                    }
                                }
                            @endphp
                        @endforeach
                        
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Age</h5>
                               
                                 <!-- Bar Chart -->
                              <div id="AgeDistributionc"></div>
                               
                                 <script>
                                     const ageRangesc = {!! json_encode(array_keys($ageCounts)) !!};
                                     const ageCountsDatac = {!! json_encode(array_values($ageCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#AgeDistributionc"), {
                                             series: [{
                                                 name: "Age",
                                                 data: ageCountsDatac
                                             }],
                                             chart: {
                                                 height: 350,
                                                 type: 'bar',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             plotOptions: {
                                                 bar: {
                                                     borderRadius: 4
                                                 }
                                             },
                                             xaxis: {
                                                 categories: ageRangesc
                                             },
                                             labels: {
                                                 show: true
                                             }
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Bar Chart -->
                               
                            </div>
                          </div>
                        </div>
                        
                        <!-- Preset Report Number 2 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Race") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Race</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="Racec"></div>
                               
                                 <script>
                                     const seriesDatac = {!! json_encode(array_values($raceCounts)) !!};
                                     const labelsc = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#Racec"), {
                                             series: seriesDatac,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labelsc
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 3 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "How did you hear about us ?") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">How did you hear about us ?</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="hearAboutUsc"></div>
                               
                                 <script>
                                     const seriesData1c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels1c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#hearAboutUsc"), {
                                             series: seriesData1c,
                                             chart: {
                                                 height: 350,
                                                 type: 'donut',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels1c
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 4 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Visit Outlet") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Visit Outlet</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="outletc"></div>
                                 <script>
                                  const seriesData2c = {!! json_encode(array_values($raceCounts)) !!};
                                  const labels2c = {!! json_encode(array_keys($raceCounts)) !!};
                                  document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#outletc"), {
                                      series: [{
                                        data: seriesData2c
                                      }],
                                      chart: {
                                        type: 'bar',
                                        height: 350
                                      },
                                      plotOptions: {
                                        bar: {
                                          borderRadius: 4,
                                          horizontal: true,
                                        }
                                      },
                                      dataLabels: {
                                        enabled: false
                                      },
                                      xaxis: {
                                        categories: labels2c,
                                      }
                                    }).render();
                                  });
                                </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 5 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Is this your first time you have eyelash extensions/lash lift/brow lamination?") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Is this your first time you have eyelash extensions/lash lift/brow lamination?</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="firstTimec"></div>
                               
                                 <script>
                                     const seriesData3c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels3c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#firstTimec"), {
                                             series: seriesData3c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels3c
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 6 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Are you getting your lash extensions. lash lift, or brow lamination applied for") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Are you getting your lash extensions. lash lift, or brow lamination applied for</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="extc"></div>
                               
                                 <script>
                                     const seriesData4c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels4c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#extc"), {
                                             series: seriesData4c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels4c
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 7 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Do you habitually rub or pull your lashes for any reason ?") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Do you habitually rub or pull your lashes for any reason ?</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="habitc"></div>
                               
                                 <script>
                                     const seriesData5c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels5c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#habitc"), {
                                             series: seriesData5c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels5c
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 8 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Do you have or are you being treated for any eye illness or injury ?") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Do you have or are you being treated for any eye illness or injury ?</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="injuryc"></div>
                               
                                 <script>
                                     const seriesData6c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels6c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#injuryc"), {
                                             series: seriesData6c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels6c
                                         }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 9 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Do you able to keep your eye's closed and lie still for up 2 hours?") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Do you able to keep your eye's closed and lie still for up 2 hours?</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="closedc"></div>
                               
                                 <script>
                                     const seriesData7c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels7c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#closedc"), {
                                             series: seriesData7c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels7c                 }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        <!-- Preset Report Number 10 -------------------------------------------------------------->
                        @php
                        $raceCounts = [];
                        @endphp
                        
                        @foreach ($submitted as $model)
                            @php
                                $fields = json_decode($model->fields, true);
                                foreach ($fields as $field) {
                                    if ($field['label'] == "Do you") {
                                        $race = $field['value'];
                                        // Increment the count for this race in the $raceCounts array
                                        $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                                    }
                                }
                            @endphp
                        @endforeach
                        <div class="col-lg-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Do you</h5>
                               
                                 <!-- Pie Chart -->
                              <div id="doc"></div>
                               
                                 <script>
                                     const seriesData8c = {!! json_encode(array_values($raceCounts)) !!};
                                     const labels8c = {!! json_encode(array_keys($raceCounts)) !!};
                                 
                                     document.addEventListener("DOMContentLoaded", () => {
                                         new ApexCharts(document.querySelector("#doc"), {
                                             series: seriesData8c,
                                             chart: {
                                                 height: 350,
                                                 type: 'pie',
                                                 toolbar: {
                                                     show: true
                                                 }
                                             },
                                             labels: labels8c
                                            }).render();
                                     });
                                 </script>
                                 
                                 <!-- End Pie Chart -->
                               
                            </div>
                          </div>
                        </div>
                        @endif
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-warning" onclick="exportReportToPDF()">Export</button>
                      </div>
                    </div>
                </div>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
      </div>
<div class="row">
@if ($chartsData !== null)
@foreach ($chartsData as $index => $item)
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == $item['chartLabels']) {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                if (is_array($race)) {
                    // Handle array values (e.g., checkboxes)
                    foreach ($race as $checkboxValue) {
                        // Increment the count for each checkbox value
                        $raceCounts[$checkboxValue] = ($raceCounts[$checkboxValue] ?? 0) + 1;
                    }
                } else {
                    // Handle string values
                    $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
                }
            }
        }
    @endphp
@endforeach
<div class="col-lg-6">
<div class="card">
<div class="card-body">
  <h5 class="card-title">{{$item['chartLabels']}}</h5>

  <!-- Pie Chart -->
  @php
      $sanitizedLabel = preg_replace('/[^a-zA-Z0-9-_]/', '_', $item['chartLabels']);
  @endphp
  <div id="{{$sanitizedLabel}}"></div>

  <script>
      const seriesData_{{$index}} = {!! json_encode(array_values($raceCounts)) !!};
      const labels_{{$index}} = {!! json_encode(array_keys($raceCounts)) !!};
  
      document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#{{$sanitizedLabel}}"), {
              series: seriesData_{{$index}},
              chart: {
                  height: 350,
                  type: 'pie',
                  toolbar: {
                      show: true
                  }
              },
              labels: labels_{{$index}}
          }).render();
      });
  </script>
  
  <!-- End Pie Chart -->

</div>
</div>
</div>
@endforeach
@else
<!-- Preset Report Number 1 -------------------------------------------------------------->
@php
$ageCounts = [
    '10-20' => 0,
    '20-30' => 0,
    '30-40' => 0,
    '40-50' => 0,
    '50++' => 0,
];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Age") {
                $age = (int)$field['value'];
                // Determine the age range and increment the count in $ageCounts
                if ($age >= 10 && $age < 20) {
                    $ageCounts['10-20']++;
                } elseif ($age >= 20 && $age < 30) {
                    $ageCounts['20-30']++;
                } elseif ($age >= 30 && $age < 40) {
                    $ageCounts['30-40']++;
                } elseif ($age >= 40 && $age < 50) {
                    $ageCounts['40-50']++;
                } else {
                    $ageCounts['50++']++;
                }
            }
        }
    @endphp
@endforeach

<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Age</h5>
       
         <!-- Bar Chart -->
      <div id="AgeDistribution"></div>
       
         <script>
             const ageRanges = {!! json_encode(array_keys($ageCounts)) !!};
             const ageCountsData = {!! json_encode(array_values($ageCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#AgeDistribution"), {
                     series: [{
                         name: "Age",
                         data: ageCountsData
                     }],
                     chart: {
                         height: 350,
                         type: 'bar',
                         toolbar: {
                             show: true
                         }
                     },
                     plotOptions: {
                         bar: {
                             borderRadius: 4
                         }
                     },
                     xaxis: {
                         categories: ageRanges
                     },
                     labels: {
                         show: true
                     }
                 }).render();
             });
         </script>
         
         <!-- End Bar Chart -->
       
    </div>
  </div>
</div>

<!-- Preset Report Number 2 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Race") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Race</h5>
       
         <!-- Pie Chart -->
      <div id="Race"></div>
       
         <script>
             const seriesData = {!! json_encode(array_values($raceCounts)) !!};
             const labels = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#Race"), {
                     series: seriesData,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 3 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "How did you hear about us ?") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">How did you hear about us ?</h5>
       
         <!-- Pie Chart -->
      <div id="hearAboutUs"></div>
       
         <script>
             const seriesData1 = {!! json_encode(array_values($raceCounts)) !!};
             const labels1 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#hearAboutUs"), {
                     series: seriesData1,
                     chart: {
                         height: 350,
                         type: 'donut',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels1
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 4 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Visit Outlet") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Visit Outlet</h5>
       
         <!-- Pie Chart -->
      <div id="outlet"></div>
         <script>
          const seriesData2 = {!! json_encode(array_values($raceCounts)) !!};
          const labels2 = {!! json_encode(array_keys($raceCounts)) !!};
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#outlet"), {
              series: [{
                data: seriesData2
              }],
              chart: {
                type: 'bar',
                height: 350
              },
              plotOptions: {
                bar: {
                  borderRadius: 4,
                  horizontal: true,
                }
              },
              dataLabels: {
                enabled: false
              },
              xaxis: {
                categories: labels2,
              }
            }).render();
          });
        </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 5 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Is this your first time you have eyelash extensions/lash lift/brow lamination?") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Is this your first time you have eyelash extensions/lash lift/brow lamination?</h5>
       
         <!-- Pie Chart -->
      <div id="firstTime"></div>
       
         <script>
             const seriesData3 = {!! json_encode(array_values($raceCounts)) !!};
             const labels3 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#firstTime"), {
                     series: seriesData3,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels3
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 6 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Are you getting your lash extensions. lash lift, or brow lamination applied for") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Are you getting your lash extensions. lash lift, or brow lamination applied for</h5>
       
         <!-- Pie Chart -->
      <div id="ext"></div>
       
         <script>
             const seriesData4 = {!! json_encode(array_values($raceCounts)) !!};
             const labels4 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#ext"), {
                     series: seriesData4,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels4
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 7 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Do you habitually rub or pull your lashes for any reason ?") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Do you habitually rub or pull your lashes for any reason ?</h5>
       
         <!-- Pie Chart -->
      <div id="habit"></div>
       
         <script>
             const seriesData5 = {!! json_encode(array_values($raceCounts)) !!};
             const labels5 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#habit"), {
                     series: seriesData5,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels5
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 8 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Do you have or are you being treated for any eye illness or injury ?") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Do you have or are you being treated for any eye illness or injury ?</h5>
       
         <!-- Pie Chart -->
      <div id="injury"></div>
       
         <script>
             const seriesData6 = {!! json_encode(array_values($raceCounts)) !!};
             const labels6 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#injury"), {
                     series: seriesData6,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels6
                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 9 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Do you able to keep your eye's closed and lie still for up 2 hours?") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Do you able to keep your eye's closed and lie still for up 2 hours?</h5>
       
         <!-- Pie Chart -->
      <div id="closed"></div>
       
         <script>
             const seriesData7 = {!! json_encode(array_values($raceCounts)) !!};
             const labels7 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#closed"), {
                     series: seriesData7,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels7                 }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
<!-- Preset Report Number 10 -------------------------------------------------------------->
@php
$raceCounts = [];
@endphp

@foreach ($submitted as $model)
    @php
        $fields = json_decode($model->fields, true);
        foreach ($fields as $field) {
            if ($field['label'] == "Do you") {
                $race = $field['value'];
                // Increment the count for this race in the $raceCounts array
                $raceCounts[$race] = ($raceCounts[$race] ?? 0) + 1;
            }
        }
    @endphp
@endforeach
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Do you</h5>
       
         <!-- Pie Chart -->
      <div id="do"></div>
       
         <script>
             const seriesData8 = {!! json_encode(array_values($raceCounts)) !!};
             const labels8 = {!! json_encode(array_keys($raceCounts)) !!};
         
             document.addEventListener("DOMContentLoaded", () => {
                 new ApexCharts(document.querySelector("#do"), {
                     series: seriesData8,
                     chart: {
                         height: 350,
                         type: 'pie',
                         toolbar: {
                             show: true
                         }
                     },
                     labels: labels8
                    }).render();
             });
         </script>
         
         <!-- End Pie Chart -->
       
    </div>
  </div>
</div>
@endif
</div>
  
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
@endsection
