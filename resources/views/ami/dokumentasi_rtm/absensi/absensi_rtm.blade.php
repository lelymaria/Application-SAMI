    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                        data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                                class="fa fa-plus color-secondary"></i>
                        </span>Add
                    </button>
                </div>
                {{-- Modal --}}

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Febby</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" data-url="#"
                                            class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                            data-bs-toggle="modal" data-bs-target="#updateProdi"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form action="#" method="post">
                                            <button class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="basicModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Presensi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-validate">
                            <form class="needs-validation" novalidate="" action="#" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom07">Nama
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <select class="default-select wide form-control" id="validationCustom05"
                                                name="nama_jurusan">
                                                <option data-display="Select">Please select</option>
                                                <option value="#"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
