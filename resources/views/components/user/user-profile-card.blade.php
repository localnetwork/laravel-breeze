<div class="cover">
    <div class="container bg-[#f3f3f3] w-full h-[350px] rounded-[10px]">

    </div>
    <div class="user-info container relative pl-[250px] py-[20px] flex justify-between">
        <div class="user-img absolute left-[70px] bottom-[70px]">
            <Link href="/profile">
                <img class="rounded-full p-[5px] bg-white h-[150px] w-[150px]" src="https://scontent.fceb1-3.fna.fbcdn.net/v/t39.30808-1/342885172_251828887229207_7402655887074568982_n.jpg?stp=dst-jpg_p200x200&_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeF1_lEglmU5Nw-OHFgT8NUHZhmicf16Wk9mGaJx_XpaT7XNPWxXieT7eZDMErfSAeC6CIYH-_sWl1DCOAlbCXa4&_nc_ohc=3lbVfQB4--IAX_1pdoF&_nc_oc=AQlkEyVAopT2TS4KmeNHfeFpmFdZpbkGcmVAukvUzdqnKLXFCyPTGDPxiFcCc0YTcC4&_nc_ht=scontent.fceb1-3.fna&oh=00_AfD5Vf36l31Rby1Dj1JxMbU99bZP6J6kGEHwjCU2XRN08Q&oe=65493BF7" />
            </Link>
        </div>
        <div>
            <h1 class="font-bold text-[50px]">{{  $user->name }}</h1>
            <span class="bg-[#00b14f] inline-block text-white rounded-[10px] text-[12px] leading-[100%] py-[6px] px-[15px]">
                @if($user->role == 1 )
                administrator
                @elseif($user->role == 2)
                sponsor
                @else
                volunteer
                @endif 
            </span>
        </div>

        <div class="flex justify-end items-end font-bold">
            <Link href='/profile/edit' class="text-black rounded-[10px] py-[10px] px-[25px] bg-[#d8dadf] flex items-center gap-x-[10px]">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="15" height="15" x="0" y="0" viewBox="0 0 492.493 492" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(0.9999999999999997,0,0,0.9999999999999997,8.526512829121202e-14,5.684341886080802e-14)"><path d="M304.14 82.473 33.165 353.469a10.799 10.799 0 0 0-2.816 4.949L.313 478.973a10.716 10.716 0 0 0 2.816 10.136 10.675 10.675 0 0 0 7.527 3.114 10.6 10.6 0 0 0 2.582-.32l120.555-30.04a10.655 10.655 0 0 0 4.95-2.812l271-270.977zM476.875 45.523 446.711 15.36c-20.16-20.16-55.297-20.14-75.434 0l-36.949 36.95 105.598 105.597 36.949-36.949c10.07-10.066 15.617-23.465 15.617-37.715s-5.547-27.648-15.617-37.719zm0 0" fill="#000000" opacity="1" data-original="#000000" class=""/></g></svg> 
                Edit Profile 
            </Link>
        </div>
    </div>
</div>