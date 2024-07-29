<x-app>
    <x-template.button.back-button url="admin/dashboard" />
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Edit Data Jadwal CSO dan CSK
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/dashboard/' . $calendarData->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <label for="color" class="form-label me-2">Color: </label>
                            <select id="color" name="color" class="form-control">
                                <option value="green" data-short="green"
                                    {{ $calendarData->color == 'green' ? 'selected' : '' }}>Green | Selesai</option>
                                <option value="yellow" data-short="yellow"
                                    {{ $calendarData->color == 'yellow' ? 'selected' : '' }}>Yellow | Sedang Berlangsung
                                </option>
                                <option value="red" data-short="red"
                                    {{ $calendarData->color == 'red' ? 'selected' : '' }}>Red | Belum di Mulai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary float-right"><i class="far fa-save"></i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
