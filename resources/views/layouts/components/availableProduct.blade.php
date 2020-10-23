
    <!-- Card -->
    <div class="card card-ecommerce">
      <!-- Card image -->
      <div class="view overlay">

          <img style="@if($item->not_available)filter: grayscale(100);@endif width: 100%;height:150px;" src="{{asset($item->photo)}}" class="img-fluid" alt="">
          <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>
      <!-- Card image -->
      <!-- Card content -->
      <div class="card-body text-right">
        <!-- Category & Title -->
        <h5 class="card-title mb-1">
          <strong>
            <p class="dark-grey-text">{{$item->name}}</a>
          </strong>
        </h5>
        <span class="badge badge-danger mb-2">{{$item->category->name}}</span>
        @if($item->not_available)<span class="badge badge-danger mb-2">غير متاح</span>@endif
        <div class="PRICE-BOX">
          <span style="">1 {{$item->unit}} = {{$item->price}} جنية</span>
        </div>
        @if(Auth::check())
        @if(auth()->user()->admin == true)
        <div class="actions card-body pt-0 mt-0 text-center">
            <a class="btn btn-danger btn-sm mdi mdi-trash-can"
            href="{{ route('product.delete', $item->id) }}"></a>
            <a class="btn btn-secondary mr-2 btn-sm mdi mdi-database-edit"
            href="{{ route('product.edit', $item->id)}}"></a>
        </div>
        @endif
        @endif
        <!-- Card footer -->
        <form method = "POST" class="addToCartForm"
          action="{{route('cart.add')}}" id="from{{$item->id}}" >
          @csrf
          <input type="hidden" name = "item->id" value="{{$item->id}}">
          <input type="hidden" name = "item->step" value="{{$item->step}}">
          <div class="pb-0">
            <div class="mb-0 d-flex flex-row align-items-center">
              <div class="price-input">
                <input id="test" type="number" min="0.0" step="any" class="qty w-100 form-control" name="qty">
                <div class="price-btns d-flex flex-column" data-step="{{$item->step}}">
                  <a class="inc-num"><span class="mdi mdi-plus btn-primary rounded" style=""></span></a>
                  <a class="dec-num"><span class="mdi mdi-minus btn-danger rounded" style="background-color: #f17f7f"></span></a>
                </div>
              </div>
              <input type="text" disabled readonly value="ك.ج" class="d-none d-md-inline w-25 px-1 text-center ml-2 form-control">
              <button @if($item->not_available) disabled @endif class="btn btn-primary @if($item->not_available) btn-dark @endif btn-sm py-1 px-2"><span class="mdi mdi-cart-plus mdi-24px" style="margin-left: 10px"></span></button>
            </div>
          </div>
        </form>
      </div>
      <!-- Card content -->
    </div>
    <!-- Card -->
