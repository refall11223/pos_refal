@csrf

<style>
  :root {
    --primary-black: #121212;
    --soft-black: #2B2B2B;
    --accent-gray: #343A40;
    --border-color: #E9ECEF;
    --bg-light: #F8F9FA;
  }

  .form-label-custom {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--primary-black);
    margin-bottom: 0.4rem;
  }

  .form-control-custom {
    border-radius: 10px;
    border: 1px solid var(--border-color);
    padding: 0.65rem 1rem;
    font-size: 0.9rem;
    background-color: var(--bg-light);
    color: var(--primary-black);
    transition: all 0.2s ease;
  }

  .form-control-custom:focus {
    background-color: #FFFFFF;
    border-color: var(--primary-black);
    box-shadow: 0 0 0 3px rgba(18, 18, 18, 0.1);
    color: var(--primary-black);
  }

  .img-preview-box {
    border: 2px dashed #CED4DA;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    background-color: var(--bg-light);
    min-height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  .btn-submit-mono {
    background-color: var(--primary-black);
    color: #FFFFFF !important;
    border: 1px solid var(--primary-black);
    border-radius: 10px;
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-submit-mono:hover {
    background-color: var(--accent-gray);
    border-color: var(--accent-gray);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .btn-cancel-mono {
    background-color: #FFFFFF;
    color: var(--primary-black) !important;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-cancel-mono:hover {
    background-color: var(--bg-light);
    border-color: #CED4DA;
  }
</style>

<div class="row g-4">
  {{-- Area Upload & Preview Foto --}}
  <div class="col-12">
    <div class="row g-3">
      {{-- Foto Saat Ini (Jika Mode Edit) --}}
      @if(!empty($produk->foto))
        <div class="col-md-4">
          <label class="form-label-custom d-block">Foto Saat Ini</label>
          <div class="img-preview-box">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
          </div>
        </div>
      @endif

      {{-- Input Upload Foto --}}
      <div class="{{ !empty($produk->foto) ? 'col-md-4' : 'col-md-6' }}">
        <label class="form-label-custom">Upload Gambar Baru</label>
        <input type="file"
               name="foto"
               onchange="previewImage(this)"
               class="form-control form-control-custom @error('foto') is-invalid @enderror"
               accept="image/*">
        <small class="text-muted mt-1 d-block">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
        @error('foto')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Preview Foto Baru yang Dipilih --}}
      <div class="{{ !empty($produk->foto) ? 'col-md-4' : 'col-md-6' }}">
        <label class="form-label-custom d-block">Preview Foto Baru</label>
        <div class="img-preview-box" id="preview-container">
          <img id="preview" class="img-fluid rounded-3" style="display:none; max-height: 140px; object-fit: cover;">
          <span id="preview-placeholder" class="text-muted fs-7">
            <i class="bi bi-image fs-3 d-block mb-1"></i>
            Pratinjau foto akan tampil di sini
          </span>
        </div>
      </div>
    </div>
  </div>

  {{-- Input Nama Produk --}}
  <div class="col-12">
    <label class="form-label-custom">Nama Produk</label>
    <input type="text" 
           name="name"
           class="form-control form-control-custom @error('name') is-invalid @enderror"
           value="{{ old('name', $produk->nama ?? '') }}"
           placeholder="Contoh: Heavyweight Cotton T-Shirt Black">
    @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- Input Harga Beli & Harga Jual --}}
  <div class="col-md-6">
    <label class="form-label-custom">Harga Beli (Rp)</label>
    <input type="number" 
           name="purchase_price"
           class="form-control form-control-custom @error('purchase_price') is-invalid @enderror"
           value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
           placeholder="0">
    @error('purchase_price')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label-custom">Harga Jual (Rp)</label>
    <input type="number" 
           name="selling_price"
           class="form-control form-control-custom @error('selling_price') is-invalid @enderror"
           value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
           placeholder="0">
    @error('selling_price')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- Input Stok --}}
  <div class="col-12">
    <label class="form-label-custom">Jumlah Stok</label>
    <input type="number" 
           name="stock"
           class="form-control form-control-custom @error('stock') is-invalid @enderror"
           value="{{ old('stock', $produk->stok ?? '') }}"
           placeholder="0">
    @error('stock')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  {{-- Tombol Aksi --}}
  <div class="col-12 d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
    @if(Route::has('produk.index'))
      <a href="{{ route('produk.index') }}" class="btn btn-cancel-mono text-decoration-none">
        Batal
      </a>
    @endif
    <button type="submit" class="btn btn-submit-mono d-inline-flex align-items-center gap-2">
      <i class="bi bi-check-lg"></i> Simpan Data
    </button>
  </div>
</div>

<script>
  function previewImage(input) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('preview-placeholder');
    const file = input.files[0];

    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.style.display = 'block';
      if (placeholder) {
        placeholder.style.display = 'none';
      }
    } else {
      preview.src = '';
      preview.style.display = 'none';
      if (placeholder) {
        placeholder.style.display = 'block';
      }
    }
  }
</script>