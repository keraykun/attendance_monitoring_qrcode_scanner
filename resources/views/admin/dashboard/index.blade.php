@extends('admin.layout')
@section('content')

<div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row mb-3">
          <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body bg-success text-white">
                  <div class="media d-flex">
                    <div class="align-self-center">
                      <i style="font-size: 4rem;" class="icon-users primary font-large-2 float-left text-white"></i>
                    </div>
                    <div class="media-body text-right">
                      <h3>{{ $student }}</h3>
                      <span>Students</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body bg-success text-white">
                  <div class="media d-flex">
                    <div class="align-self-center">
                      <i style="font-size: 4rem;" class="icon-users primary font-large-2 float-left text-white"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3>{{ $teacher }}</h3>
                        <span>Teacher</span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body bg-success text-white">
                  <div class="media d-flex">
                    <div class="align-self-center">
                      <i style="font-size: 4rem;" class="icon-users primary font-large-2 float-left text-white"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3>{{ $admin }}</h3>
                        <span>Admin</span>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>

      </div>
      <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body bg-success text-white">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i style="font-size: 4rem;" class="icon-home primary font-large-2 float-left text-white"></i>
                  </div>
                  <div class="media-body text-right">
                    <h3>{{ $room }}</h3>
                    <span>Room</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body bg-success text-white">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i style="font-size: 4rem;" class="icon-graduation primary font-large-2 float-left text-white"></i>
                  </div>
                  <div class="media-body text-right">
                      <h3>{{ $grade }}</h3>
                      <span>Grade Year</span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body bg-success text-white">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i style="font-size: 4rem;" class="icon-list primary font-large-2 float-left text-white"></i>
                  </div>
                  <div class="media-body text-right">
                      <h3>{{ $schedule }}</h3>
                      <span>Schedule</span>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>

    </div>
    </section>
</div>


@endsection
