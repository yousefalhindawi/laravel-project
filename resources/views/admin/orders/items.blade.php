@extends('layouts.admin')

@section('content')
    {{-- @php
        echo '<pre>;';
          print_r($users->city);
        echo '<pre>;';
    @endphp --}}
              <!-- Hoverable Table rows -->
              @if(session()->has('message'))
                <div class="alert alert-success ">
                    {{ session()->get('message') }}
                </div>
              @endif
              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                          <th>Item</th>
                          <th>Description</th>
                          <th>Condition</th>
                          <th>Image</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    @php
                        $i = 0;
                    @endphp
                    <tbody class="table-border-bottom-0">
                      @foreach ($items as  $item)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$orders_package[$i]->title}}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{substr($orders_package[$i]->description,0,50)}}</strong></td>
                        <td><span class="badge bg-label-{{$orders_package[$i]->condition == 'Poor' ? 'warning' : 'success'}} me-1">{{$orders_package[$i]->condition}}</span></td>
                        <td><img src="/image/{{$orders_package[$i]->image}}" alt="Avatar" class="" width="100" height="100" /></td>
                        {{-- <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$items_package[$i]->title ?? 'none'}}</strong></td> --}}

                        <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                            <form action="{{ route('orders.destroy' ,  $orders_package[$i]->id)}}" method="POST" class="d-inline">
                              @method('DELETE')
                              @csrf
                              <span  class="dropdown-item"
                              ><i class="bx bx-trash me-1"></i> <button style="border: none; background-color:transparent;margin:0;padding:0;font-weight: 400;
                              color: #697a8d;">Delete</button></span
                              >
                            </form>
                            </div>
                        </div>
                        </td>
                      </tr>
                      @php
                          $i++;
                      @endphp
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>

              {{-- pagination --}}
              <div class="pagination-wrapper">
                {{ $items->links('pagination::bootstrap-4')}}
              </div>

              <!--/ Hoverable Table rows -->
@endsection
