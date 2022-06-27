<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
    <div class="col-sm-12 col-md-7">
        <input class="form-control" type="text" name="title"  value="{{ old('title') ?? $questionnaire->title }}" placeholder="" required="" aria-describedby="titleHelpBlock">
        <small id="titleHelpBlock" class="form-text text-muted">
            Silahkan isi dengan judul kuesioner.
        </small>
    </div>
</div>
<div class="form-group row mb-4">
<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
    <div class="col-sm-12 col-md-7">
        <textarea class="form-control" name="purpose" value="{{ old('purpose') ?? $questionnaire->purpose }}" placeholder="" required="" aria-describedby="purposeHelpBlock">{{ $questionnaire->purpose }}</textarea>
        <small id="purposeHelpBlock" class="form-text text-muted">
            Silahkan isi dengan deskripsi kuesioner.
        </small>
    </div>
</div>
<div class="form-group row mb-4">
<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Periode</label>
    <div class="col-sm-12 col-md-7">
        <input id="datepickers" class="form-control" type="text" name="period" value="{{ old('period') ?? $questionnaire->period }}" required="" aria-describedby="periodHelpBlock">
        <small id="periodHelpBlock" class="form-text text-muted">
            Silahkan isi dengan periode kuesioner. Contoh : 2017
        </small>
    </div>
</div>
<div class="form-group row mb-4">
<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Tutup</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" class="form-control datepicker" name="due_date" value="{{ old('due_date') ?? $questionnaire->due_date }}" required="" aria-describedby="dueHelpBlock">
        <small id="dueHelpBlock" class="form-text text-muted">
            Silahkan isi dengan tanggal tutup pengisian kuesioner. Contoh : 2017-08-01
        </small>
    </div>
</div>
<div class="card-footer">
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
        <div class="col-sm-12 col-md-7">
        <a href="{{ route('questionnaires.index') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ $submit_button }}</button>
        </div>
    </div>
</div>
