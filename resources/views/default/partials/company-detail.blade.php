<div class="company-detail-template-wrapper">
    <div class="row">
        <div class="col-sm-12 col-md-3 company-logo">
            <img src="/storage/{{$company->logo}}" onerror="this.setAttribute('src','/images/placeholder.png')"/>
        </div>
        <div class="col-sm-12 col-md-9">
            <h2>{{$company->name}}</h2>
            @if($company->address)
                <div>
                    <strong>Địa chỉ:</strong> {{$company->address->show()}}
                </div>
            @endif
            @if($company->phone)
                <div>
                    <strong>Điện thoại:</strong> {{$company->phone}}
                </div>
            @endif
            @if($company->email)
                <div>
                    <strong>Email:</strong> {{$company->email}}
                </div>
            @endif
            @if($company->website)
                <div>
                    <strong>Website:</strong> {{$company->website}}
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            {!! $company->overview !!}
        </div>
    </div>
</div>
