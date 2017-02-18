<link href="{{ asset('/css/companies/companiesList.css') }}" rel="stylesheet">

@foreach($companies as $company)
    <div class="col-xs-12 oll-companies-list">
        <div class="col-xs-3 imeg-companies-list">
            @if(File::exists(public_path('image/vacancy/' . $company->company_id . '.png')))
                {!! Html::image('image/vacancy/' . $company->company_id . '.png', 'logo', ['id' => 'vacImg', 'width' => '100%', 'height' => '100%']) !!}
            @elseif(File::exists(public_path('image/vacancy/' . $company->company_id . '.jpg')))
                {!! Html::image('image/vacancy/' . $company->company_id . '.jpg', 'logo', ['id' => 'vacImg', 'width' => '100%', 'height' => '100%']) !!}
            @elseif(File::exists(public_path('image/vacancy/' . $company->company_id . '.jpeg')))
                {!! Html::image('image/vacancy/' . $company->company_id . '.jpeg', 'logo', ['id' => 'vacImg', 'width' => '100%', 'height' => '100%']) !!}
            @elseif(File::exists(public_path('image/vacancy/' . $company->company_id . '.bmp')))
                {!! Html::image('vacancies' . $company->company_id . '.bmp', 'logo', ['id' => 'vacImg', 'width' => '100%', 'height' => '100%']) !!}
            @else
                <h3 class="nologo-companies-list">логотип вiдсутнiй</h3>
            @endif
        </div>
        <div class="col-xs-9 content-companies-list">
            <div class="section-links">
                <div>
                    <a class="links-line-companies-list" href="/company/{{$company->id}}" >
                        <h3 class="name-companies-list">{{$company->company_name}}</h3>
                    </a>
                </div>
                <div class="amount-companies-list">
                    <p>1 Вакансія</p>
                </div>
                <div class="row description-companies">
                    <div>{{strip_tags($company->description)}}</div>
                </div>
            </div>
            <a class="links-line-companies-list" href="/company/{{$company->id}}">
                <p class="read-next-link">Читати далі...</p>
            </a>
        </div>
    </div>
    <hr class="limit-line-w">
@endforeach