@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-header">Table Shipment Orders</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama Barang</th>
            <th class="text-white">Berat Barang</th>
            <th class="text-white">Harga Barang</th>
            <th class="text-white">Tracking</th>
            <th class="text-white">User Name</th>
            <th class="text-white">User Email</th>
            <th class="text-white">Sender Phone</th>
            <th class="text-white">Sender Address</th>
            <th class="text-white">Recipient Name</th>
            <th class="text-white">Recipient Phone</th>
            <th class="text-white">Recipient Address</th>
            <th class="text-white">Courier</th>
            <th class="text-white">Service</th>
            <th class="text-white">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($shipmentOrders as $order)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->shipmentItems->first()->name ?? '-' }}</td>
            <td>{{ $order->shipmentItems->first()->weight ?? '-' }}</td>
            <td>{{ $order->shipmentItems->first()->price ?? '-' }}</td>
            <td><a href="{{ $order->tracking }}" target="_blank" class="btn btn-sm btn-success">Track</a></td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>{{ $order->user->email ?? '-' }}</td>
            <td>{{ $order->sender->phone ?? '-' }}</td>
            <td>{{ $order->sender->address ?? '-' }}</td>
            <td>{{ $order->recipient->name ?? '-' }}</td>
            <td>{{ $order->recipient->phone ?? '-' }}</td>
            <td>{{ $order->recipient->address ?? '-' }}</td>
            <td>{{ $order->courier_name }}</td>
            <td>{{ $order->service_name }}</td>
            <td>{{ $order->status }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('shipment.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <!-- Courier & Service -->
            <div class="mb-3">
              <label class="form-label">Kurir</label>
              <input type="text" class="form-control" name="courier" required value="Kurir">
            </div>
            <div class="mb-3">
              <label class="form-label">Layanan</label>
              <input type="text" class="form-control" name="service" required value="Blue Cargo">
            </div>
        
            <!-- Address Pengirim -->
            <div class="mb-3">
              <label class="form-label">Alamat Pengirim</label>
              <input type="text" class="form-control" name="address" required value="Jalan jalan">
            </div>
        
            <!-- Data Penerima -->
            <h6>Data Penerima</h6>
            <div class="mb-3">
              <label class="form-label">Nama Penerima</label>
              <input type="text" class="form-control" name="name" required value="Penerima">
            </div>
            <div class="mb-3">
              <label class="form-label">Telepon Penerima</label>
              <input type="text" class="form-control" name="phone" required value="081221321321">
            </div>
            <div class="mb-3">
              <label class="form-label">Weight</label>
              <input type="number" class="form-control" name="weight" required value="4000">
            </div>
            <div class="mb-3">
              <label class="form-label">Price</label>
              <input type="number" class="form-control" name="price" required value="45000">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
  

<!-- Edit Modal -->
@foreach ($shipmentOrders as $shipment)
<div class="modal fade" id="editModal{{ $shipment->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Pengiriman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('shipment.update', $shipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          
          <!-- Courier & Service -->
          <div class="mb-3">
            <label class="form-label">Kurir</label>
            <input type="text" class="form-control" name="courier" value="{{ $shipment->courier_name }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Layanan</label>
            <input type="text" class="form-control" name="service" value="{{ $shipment->service_name }}" required>
          </div>
      
          <!-- Address Pengirim -->
          <div class="mb-3">
            <label class="form-label">Alamat Pengirim</label>
            <input type="text" class="form-control" name="address" value="{{ $shipment->sender->address }}" required>
          </div>
      
          <!-- Data Penerima -->
          <h6>Data Penerima</h6>
          <div class="mb-3">
            <label class="form-label">Nama Penerima</label>
            <input type="text" class="form-control" name="name" value="{{ $shipment->recipient->name }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telepon Penerima</label>
            <input type="text" class="form-control" name="phone" value="{{ $shipment->recipient->phone }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
@endforeach

@endsection