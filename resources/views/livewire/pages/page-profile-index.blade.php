<x-layouts.main-content-index>

  <x-layouts.main-content-nav page-title="Profile"/>


  <section class="mt-5 section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ $temp_profile_picture }}" alt="Profile" class="rounded-circle">
            <h2>{{ $user['name'] }}</h2>
            <h3>{{ $user['email'] }}</h3>
            {{-- <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> --}}
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs">

              <li class="nav-item">
                <button wire:click.prevent="$set('currentPage', 'overview')" class="nav-link {{ $this->currentPage == 'overview' ? 'active' : null }}" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button wire:click.prevent="$set('currentPage', 'edit_profile')" class="nav-link {{ $this->currentPage == 'edit_profile' ? 'active' : null }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              {{-- <li class="nav-item">
                <button wire:click.prevent="$set('currentPage', 'settings')" class="nav-link {{ $this->currentPage == 'settings' ? 'active' : null }}" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li> --}}

              <li class="nav-item">
                <button wire:click.prevent="$set('currentPage', 'change_password')" class="nav-link {{ $this->currentPage == 'change_password' ? 'active' : null }}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade {{ $this->currentPage == 'overview' ? 'show active' : null }} profile-overview" id="profile-overview">
          
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Name</div>
                  <div class="col-lg-9 col-md-8">{{ $user['name'] }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $user['email'] }}</div>
                </div>

                @role('admin')
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Type</div>
                    <div class="col-lg-9 col-md-8">{{ $user['role'] }}</div>
                  </div>
                @endrole

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ $user['mobile'] }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Facebook</div>
                  <div class="col-lg-9 col-md-8"><a href="{{ $user['fb'] }}">{{ $user['fb'] }}</a></div>
                </div>
              </div>

              <div class="tab-pane fade {{ $this->currentPage == 'edit_profile' ? 'show active' : null }} profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form wire:submit.prevent="update_profile">


                  {{-- <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{ $temp_profile_picture }}" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div> --}}

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.name" type="text" class="form-control @error('user.name') is-invalid @enderror">
                      @error('user.email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.email" type="text" class="form-control @error('user.email') is-invalid @enderror">
                      @error('user.email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <hr class="my-4">


                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.mobile" type="text" class="form-control @error('user.mobile') is-invalid @enderror" value="Lueilwitz, Wisoky and Leuschke">
                      @error('user.mobile')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror 
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.fb" type="text" class="form-control @error('user.fb') is-invalid @enderror">
                      @error('user.fb')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>


{{-- 

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                    </div>
                  </div> --}}

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              {{-- <div class="tab-pane fade {{ $this->currentPage == 'settings' ? 'show active' : null }} pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div> --}}

              <div class="tab-pane fade {{ $this->currentPage == 'change_password' ? 'show active' : null }} pt-3" id="profile-change-password">
                <!-- Change Password Form -->

                <form wire:submit.prevent="update_password">

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.password" type="password" class="form-control @error('user.password') is-invalid @enderror">
                      @error('user.password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.new_password" type="password" class="form-control @error('user.new_password') is-invalid @enderror">
                      @error('user.new_password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input wire:model.defer="user.confirm_new_password" type="password" class="form-control @error('user.confirm_new_password') is-invalid @enderror">
                      @error('user.confirm_new_password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
</x-layouts.main-content-index>
