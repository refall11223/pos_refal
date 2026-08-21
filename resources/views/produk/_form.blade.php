@csrf

<style>
  :root {
    --color-blue: #2563EB;
    --color-black: #0F172A;
    --color-gray: #94A3B8;
  }

  .form-label-custom {
    font-weight: 600;
    font-size: 0.875rem;
    color: #FFFFFF;
    margin-bottom: 0.4rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .form-control-custom {
    border-radius: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    padding: 0.65rem 1rem !important;
    font-size: 0.9rem !important;
    background-color: rgba(15, 23, 42, 0.4) !important;
    color: #FFFFFF !important;
    transition: all 0.25s ease !important;
  }

  .form-control-custom::placeholder {
    color: var(--color-gray) !important;
  }

  .form-control-custom:focus {
    background-color: rgba(15, 23, 42, 0.6) !important;
    border-color: var(--color-blue) !important;
    box-shadow: 0 0 12px rgba(37, 99, 235, 0.4) !important;
    color: #FFFFFF !important;
  }

  .img-preview-box {
    border: 2px dashed rgba(255, 255, 255, 0.25);
    border-radius: 14px;
    padding: 10px;
    text-align: center;
    background-color: rgba(15, 23, 42, 0.4);
    min-height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    backdrop-filter: blur(8px);
  }

  .btn-submit-mono {
    background-color: var(--color-blue) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(37, 99, 235, 0.5) !important;
    border-radius: 12px;
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
  }

  .btn-submit-mono:hover {
    background-color: #1D4ED8 !important;
    border-color: #1D4ED8 !important;
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    transform: translateY(-2px);
  }

  .btn-cancel-mono {
    background-color: rgba(255, 255, 255, 0.08) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 12px;
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    transition: all 0.25s ease;
  }

  .btn-cancel-mono:hover {
    background-color: rgba(255, 255, 255, 0.18) !important;
    border-color: rgba(255, 255, 255, 0.35) !important;
    color: #FFFFFF !important;
  }

  .border-top-custom {
    border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
  }
</style>

{{-- Ringkasan Error Atas (Membantu Pengguna Mengetahui Kesalahan) --}}
@if ($errors->any())
  <div class="alert text-white mb-4" style="background: rgba(220, 38, 38, 0.25); border: 1px solid rgba(239, 68, 68, 0.5); backdrop-filter: blur(10px); border-radius: 14px;">
    <div class="fw-bold mb-1 d-flex align-items-center gap-2">
      <i class="bi bi-exclamation-octagon-fill text-danger fs-5"></i> Gagal Menyimpan Data
    </div>
    <ul class="mb-0 ps-3 small text-white-50">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

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
        <small class="text-white-50 mt-1 d-block">Format: JPG, JPEG, PNG, WEBP (Maks. 2MB)</small>
        @error('foto')
          <div class="invalid-feedback d-block text-danger mt-1">
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Preview Foto Baru yang Dipilih --}}
      <div class="{{ !empty($produk->foto) ? 'col-md-4' : 'col-md-6' }}">
        <label class="form-label-custom d-block">Preview Foto Baru</label>
        <div class="img-preview-box" id="preview-container">
          <img id="preview" class="img-fluid rounded-3" style="display:none; max-height: 140px; object-fit: cover;">
          <span id="preview-placeholder" class="text-white-50 fs-7">
            <i class="bi bi-image fs-3 d-block mb-1 text-white-50"></i>
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
           class="form-control form-control-custom @error('name') is-invalid @enderror @error('nama') is-invalid @enderror"
           value="{{ old('name', old('nama', $produk->nama ?? '')) }}"
           placeholder="Contoh: Heavyweight Cotton T-Shirt Black">
    @error('name')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
    @error('nama')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>

  {{-- Input Harga Beli & Harga Jual --}}
  <div class="col-md-6">
    <label class="form-label-custom">Harga Beli (Rp)</label>
    <input type="number" 
           name="purchase_price"
           class="form-control form-control-custom @error('purchase_price') is-invalid @enderror @error('harga_beli') is-invalid @enderror"
           value="{{ old('purchase_price', old('harga_beli', $produk->harga_beli ?? '')) }}"
           placeholder="0">
    @error('purchase_price')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
    @error('harga_beli')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label-custom">Harga Jual (Rp)</label>
    <input type="number" 
           name="selling_price"
           class="form-control form-control-custom @error('selling_price') is-invalid @enderror @error('harga_jual') is-invalid @enderror"
           value="{{ old('selling_price', old('harga_jual', $produk->harga_jual ?? '')) }}"
           placeholder="0">
    @error('selling_price')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
    @error('harga_jual')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>

  {{-- Input Stok --}}
  <div class="col-12">
    <label class="form-label-custom">Jumlah Stok</label>
    <input type="number" 
           name="stock"
           class="form-control form-control-custom @error('stock') is-invalid @enderror @error('stok') is-invalid @enderror"
           value="{{ old('stock', old('stok', $produk->stok ?? '')) }}"
           placeholder="0">
    @error('stock')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
    @error('stok')
      <div class="invalid-feedback d-block text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>

  {{-- Tombol Aksi --}}
  <div class="col-12 d-flex justify-content-end gap-2 mt-4 pt-3 border-top-custom">
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