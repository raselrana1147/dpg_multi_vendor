<?php 
use App\Models\Admin\GeneralSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


function site_name()
{
	$data=GeneralSetting::first();
	return $data->site_name;
}

function site_tite()
{
	$data=GeneralSetting::first();
	return $data->title;
}

function copyright()
{
	$data=GeneralSetting::first();
	return $data->copyright;
}


function logo()
{
	$data=GeneralSetting::first();
	return $data->logo;
}

function favicon()
{
	$data=GeneralSetting::first();
	return $data->favicon;
}

function loader_image()
{
	$data=GeneralSetting::first();
	return $data->loader;
}

function slider_background()
{
	$data=GeneralSetting::first();
	return $data->slider_background;
}

function tax()
{
	$data=GeneralSetting::first();
	return $data->tax;
}

function shipping_charge()
{
	$data=GeneralSetting::first();
	return $data->shipping_charge;
}


function currency()
{
	$data=GeneralSetting::first();
	return $data->currency;
}


function default_image()
{
	$data=GeneralSetting::first();
	return $data->default_image;
}


function company_address()
{
	$data=GeneralSetting::first();
	return $data->company_address;
}


function description()
{
	$data=GeneralSetting::first();
	return $data->description;
}


function company_phone()
{
	$data=GeneralSetting::first();
	return $data->company_phone;
}


function company_email()
{
	$data=GeneralSetting::first();
	return $data->company_email;
}


function facebook()
{
	$data=GeneralSetting::first();
	return $data->facebook;
}

function instrgram()
{
	$data=GeneralSetting::first();
	return $data->instrgram;
}

function youtube()
{
	$data=GeneralSetting::first();
	return $data->youtube;
}



function twitter()
{
	$data=GeneralSetting::first();
	return $data->twitter;
}



function linkedin()
{
	$data=GeneralSetting::first();
	return $data->linkedin;
}

function locale()
{
	$locale=Session::has('locale') ? Session::get('locale') : "en"; 
	$image=null;
	switch ($locale) 
	{
		case 'bn':
			$image="bn.png";
			break;
		
		default:
			$image="us.png";
			break;
	}
	return $image;
}

function short_description($description,$start,$length)
{
	return substr($description,$start,$length);

}




