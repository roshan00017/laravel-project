
<?php
$applyToAllHolidays = $holidays['apply_to_all'];
$applyToProvinceHolidays = $holidays['apply_to_province'];
$applyToDistrictHolidays = $holidays['apply_to_district'];
$applyToValleyHolidays = $holidays['apply_to_valley'];
$applyToLocalBodyHolidays = $holidays['apply_to_localBody'];
?>

@if(count($applyToAllHolidays) > 0)
    @foreach($applyToAllHolidays as $allHoliday)
        <br/><small class="text-danger">{{$allHoliday->name}}</small>
    @endforeach
@endif

@if(count($applyToProvinceHolidays) > 0)
    @foreach($applyToProvinceHolidays as $provinceHoliday)
        <br/><small class="text-danger">{{$provinceHoliday->name}}</small>
    @endforeach
@endif

@if(count($applyToDistrictHolidays) > 0)
    @foreach($applyToDistrictHolidays as $districtHoliday)
        <br/><small class="text-danger">{{$districtHoliday->name}}</small>
    @endforeach
@endif

@if(count($applyToValleyHolidays) > 0)
    @foreach($applyToValleyHolidays as $valleyHoliday)
        <br/><small class="text-danger">{{$valleyHoliday->name}}</small>
    @endforeach
@endif

@if(count($applyToLocalBodyHolidays) > 0)
    @foreach($applyToLocalBodyHolidays as $localBodyHoliday)
        <br/><small class="text-danger">{{$localBodyHoliday->name}}</small>
    @endforeach
@endif

