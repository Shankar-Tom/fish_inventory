<div class="row">
    <div class="form-group col-6">
        <label for="exampleInputEmail3">Select Port</label>
        @php($ports=\App\Models\Port::where('status',1)->get())
        <select name="portid" id="" class="form-control" wire:model="portid">
             <option>Select Port</option>
          @foreach ($ports as $port)
              <option value="{{$port->id}}">{{$port->port_name}}</option>
          @endforeach
        </select>               
     </div>
     <div class="form-group col-6">
        <label for="exampleInputEmail3">Select Seller</label>
        <select name="seller" id="" class="form-control">
           
          @forelse ($sellers as $seller)
              <option value="{{$seller->id}}">{{$seller->party_name}}</option>
              @empty
              <option >No Seller on this port</option>
          @endforelse
        </select>               
     </div>
</div>


