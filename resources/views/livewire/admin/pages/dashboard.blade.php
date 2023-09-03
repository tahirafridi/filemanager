<div class="content-wrapper">
    <div class="content-header">
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="row mt-4">
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $dashboard['users_count'] }}</h3>
                                    <p>Total Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $dashboard['folders_count'] }}</h3>
                                    <p>Total Folders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $dashboard['files_count'] }}</h3>
                                    <p>Total Files</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ $dashboard['downloads_count'] }}</h3>
                                    <p>Total Downloads</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cloud-download-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-white">
                                <div class="inner">
                                    <h3>{{ niceFileSize($dashboard['total_filesize']) }}</h3>
                                    <p>Total Storage Used</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hdd"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
