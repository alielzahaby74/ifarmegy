
    <!-- Card -->
    <div class="card card-ecommerce">
      <!-- Card image -->
      <div class="view overlay">
        
          <img style="width: 100%;height:150px;" src="{{asset($item_photo)}}" class="img-fluid" alt="">
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
            <p class="dark-grey-text">{{$item_name}}</a>
          </strong>
        </h5>
        <span class="badge badge-danger mb-2">{{$item_category}}</span>
        <div class="PRICE-BOX">
          <span style="">1 {{$item_unit}} = {{$item_price}} جنية</span>
        </div>
        <!-- Card footer -->
        <form method = "POST" class="addToCartForm" 
          action="{{route('cart.add')}}" id="from{{$item_id}}" >
          @csrf
          <input type="hidden" name = "item_id" value="{{$item_id}}">
          <input type="hidden" name = "item_step" value="{{$item_step}}">
          <div class="pb-0">
            <div class="mb-0 d-flex flex-row align-items-center">
              <div class="price-input">
                <input id="test" type="number" min="0.0" step="any" class="qty w-100 form-control" name="qty">
                <div class="price-btns d-flex flex-column" data-step="{{$item_step}}">
                  <a class="inc-num"><span class="mdi mdi-plus btn-primary rounded" style=""></span></a>
                  <a class="dec-num"><span class="mdi mdi-minus btn-danger rounded" style="background-color: #f17f7f"></span></a>  
                </div>
              </div>
              <input type="text" disabled readonly value="ك.ج" class="d-none d-md-inline w-25 px-1 text-center ml-2 form-control">
              <button class="btn btn-primary btn-sm py-1 px-2"><span class="mdi mdi-cart-plus mdi-24px" style="margin-left: 10px"></span></button>
            </div>
          </div>
        </form>
      </div>
      <!-- Card content -->
    </div>
    <!-- Card -->