<?php
use App\Models\Attendance;
use App\Models\ai;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
if (isset($_COOKIE['user_identity']))
    $Attendance = Attendance::where('user_identity',$_COOKIE['user_identity'])->get();


$ids = json_decode(request()->cookie('seen_angizeh_ids','[]'), true) ?: [];
$s = ai::where('key','angizeh')
    ->when($ids, fn($q) => $q->whereNotIn('id',$ids))
    ->orderByDesc('id')
    ->first()
    ?? ai::where('key','angizeh')->orderByDesc('id')->first();
$ids = array_merge($ids, [$s->id]);
Cookie::queue('seen_angizeh_ids', json_encode($ids), 14400);

//dd($Attendance)
?>
@extends('app')
@section('content')
    <div class="container"
         style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;margin: 90px 0 10px 0 ">
        <form id="attendanceForm" class="form" action="{{url('attendance/enter')}}" method="post" style="text-align: left">
            @csrf
            <p class="title text-center font-bold text-lg mb-2">سامانه گذارش کار</p>
            <p class="message text-right text-sm text-gray-700">
                {{$s->response}}
{{--                اگر دکمه <span class="text-green-600 font-bold">سبز</span> یا <span--}}
{{--                        class="text-blue-600 font-bold">آبی</span> بود، ورود شما تأیید شده است.--}}
{{--                اگر <span class="text-orange-500 font-bold">نارنجی</span> بود، خارج از محدوده هستید و ورود به‌صورت <span--}}
{{--                        class="font-bold">دورکاری</span> ثبت می‌شود و نیاز به تأیید مدیر دارد.--}}
            </p>

            @php
                $user_identity = $_COOKIE['user_identity'] ?? '';
            @endphp

            <label>
                <input required placeholder="" name="name" type="text" class="input" value="{{ $user_identity }}">
                <span>شناسه</span>
            </label>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="distance" id="distance">
            <button id="submitBtn" disabled type="button" class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                در حال بررسی موقعیت...
            </button>
        </form>
    </div>

    <script>
      const referenceLat = 32.6504751;
      const referenceLng = 51.6936045;

      const submitBtn = document.getElementById("submitBtn");
      const latInput = document.getElementById("latitude");
      const lngInput = document.getElementById("longitude");
      const distanceInput = document.getElementById("distance");
      const form = document.getElementById("attendanceForm");

      function getDistanceInMeters(lat1, lon1, lat2, lon2) {
        const earthRadius = 6371000; // meters
        const toRad = deg => deg * Math.PI / 180;
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        lat1 = toRad(lat1);
        lat2 = toRad(lat2);
        const a = Math.sin(dLat / 2) ** 2 +
          Math.cos(lat1) * Math.cos(lat2) * Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return earthRadius * c;
      }

      navigator.geolocation.getCurrentPosition(
        position => {
          const lat = position.coords.latitude;
          const lng = position.coords.longitude;

          latInput.value = lat;
          lngInput.value = lng;

          const dist = Math.round(getDistanceInMeters(referenceLat, referenceLng, lat, lng));
          distanceInput.value = dist;
          submitBtn.textContent = `فاصله: ${dist} متر`;

          submitBtn.classList.remove("bg-gray-400", "bg-blue-500", "bg-green-500", "bg-orange-500", "cursor-not-allowed");
          if (dist < 10) {
            submitBtn.classList.add("bg-green-500", "hover:bg-green-600");
          } else if (dist < 50) {
            submitBtn.classList.add("bg-blue-500", "hover:bg-blue-600");
          } else if (dist > 2000) {
            submitBtn.classList.add("bg-orange-500", "hover:bg-orange-600");
          } else {
            submitBtn.classList.add("bg-gray-400");
          }
          submitBtn.disabled = false;
        },
        error => alert("⛔ خطا در دریافت موقعیت مکانی: " + error.message),
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
      );
      const attendanceForm = document.getElementById('attendanceForm');

      const output = document.getElementById('output');
      const challenge = new Uint8Array(32); window.crypto.getRandomValues(challenge);
      const createOptions = {
        challenge, rp: { name: "مثال سایت شما" },
        user: { id: Uint8Array.from('user-id', c => c.charCodeAt(0)), name: "user@example.com", displayName: "نام کاربر" },
        pubKeyCredParams: [{ type: 'public-key', alg: -7 }],
        authenticatorSelection: { authenticatorAttachment: "platform", userVerification: "required" },
        timeout: 60000, attestation: "direct"
      };
      submitBtn.addEventListener('click', async () => {

        // ابتدا اعتبارسنجی اثر انگشت توسط WebAuthn
        if (!window.PublicKeyCredential) {
          alert('مرورگر شما از احراز هویت بیومتریک پشتیبانی نمی‌کند.');
          return;
        }
        try {
          const credential = await navigator.credentials.create({ publicKey: createOptions });
          attendanceForm.submit();
        } catch (error) {
          output.textContent = error.name === 'NotAllowedError' ? 'احراز هویت لغو شد یا دسترسی مجاز نبود.' : 'عملیات ناموفق بود. لطفاً دوباره امتحان کنید.';
        }
      });
    </script>

    <div class="w-full flex justify-center">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white max-w-[350px]">
            <input type="text" id="searchInput" placeholder="جستجو..."
                   class="p-2  w-full text-right focus:outline-none focus:none" style="padding: 14px;width:350px">
            <!-- Your Table Code Here -->
            <div style="overflow-x:scroll;">

                @if(isset($_COOKIE['user_identity']))
                    <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
                        <thead class=" text-black sticky top-0 z-10"
                               style="background: rgba(244,244,244,0.82);border-bottom: 1px solid;border-color: #e1e1e1 ">
                        <tr>
                            <th class="py-3 px-6 text-right font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">ورود
                            </th>
                            <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">خروج
                            </th>
                            <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">جمع
                            </th>
                            <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">جمع استراحت
                            </th>

                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($Attendance->sortByDesc('entered_at') as $item)
                            <tr class="hover:bg-red-100 cursor-pointer"
                                onclick="openModal('{{ $item->id }}', '{{ $item->id }}')">

                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right"
                                    style="background-color: {{ $item->distance < 10 ? '#d1fae5' : ($item->distance < 50 ? '#dbeafe' : ($item->distance > 2000 ? '#ffedd5' : '#f3f4f6') ) }}; color: #111827;">
                                    {{ $item->entered_at ? Jalalian::fromCarbon(Carbon::parse($item->entered_at))->format('H:i m/d') : '-' }}
                                </td>

                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center"
                                    style="background-color: {{ $item->distance_exit < 10 ? '#d1fae5' : ($item->distance_exit < 50 ? '#dbeafe' : ($item->distance_exit > 2000 ? '#ffedd5' : '#f3f4f6') ) }}; color: #111827;">
                                    {{ $item->exited_at ? Jalalian::fromCarbon(Carbon::parse($item->exited_at))->format('H:i m/d') : '-' }}
                                </td>

                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $item->entered_at && $item->exited_at ? \Carbon\Carbon::parse($item->entered_at)->diff(\Carbon\Carbon::parse($item->exited_at))->format('%H:%I') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">0</td>

                            </tr>
                            <tr class="spacer">
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif

            </div>
        </div>

    </div>

    <!-- Modals -->
    <!-- Modals -->
    <div id="modal-container"
         class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4">
        <div id="modal-content" class="bg-white p-4 sm:p-6 rounded-lg shadow-lg max-w-sm w-full relative">
            <h2 id="modal-title" class="text-xl sm:text-2xl font-semibold mb-4 text-center"></h2>
            <p id="modal-body" class="text-gray-700 mb-4 text-center"></p>
            <div class="flex justify-center gap-2">
                <a id="panel-access-link" href="#" class="bg-green-500 text-white rounded p-2" title="Panel Access">
                    ورودبه پنل کاربر
                </a>
                <button class="bg-yellow-500 text-white rounded p-2" title="Resend Password">
                    ارسال دوباره رمز
                </button>
            </div>
            <div class="flex justify-center gap-2">


                <form id="panel-access-link-edite" action="#" class=" text-white rounded p-2" title="Panel Access"
                      method="post">@csrf
                    <button class="bg-blue-500 text-white rounded p-2" title="Edit" style="width: 44px">
                        <i class="fas fa-edit text-white text-lg"></i>
                    </button>
                </form>
                <form id="panel-access-link-delete" action="#" class=" text-white rounded p-2" title="Panel Access"
                      method="post">@csrf
                    <button class="bg-red-500 text-white rounded p-2" title="Delete" style="width: 44px">
                        <i class="fas fa-trash text-white text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

      function openModal(title, id) {
        document.getElementById("modal-title").innerText = title; // Set modal title
        document.getElementById("panel-access-link-edite").action = `/edit/${id}`;
        document.getElementById("panel-access-link-delete").action = `/delete/${id}`;
        const panelLink = document.getElementById("panel-access-link");
        panelLink.href = `/go_down/${id}`;
        document.getElementById("modal-container").classList.remove("hidden"); // Show modal
      }

      function closeModal() {
        document.getElementById("modal-container").classList.add("hidden");
      }

      document.getElementById("modal-container").addEventListener("click", (e) => {
        if (e.target === document.getElementById("modal-container")) {
          closeModal();
        }
      });

      async function getContacts() {
        if ("contacts" in navigator && "ContactsManager" in window) {
          const properties = ["name", "tel"];
          const options = { multiple: true };

          try {
            const contacts = await navigator.contacts.select(properties, options);
            displayContacts(contacts);
          } catch (error) {
            alert("دسترسی به مخاطبین رد شد یا امکان‌پذیر نیست.");
            console.error(error);
          }
        } else {
          alert("مرورگر شما از API مخاطبین پشتیبانی نمی‌کند.");
        }
      }

      function displayContacts(contacts) {
        const contactsTextarea = document.getElementById("contacts");
        const formContainer = document.getElementById("formContainer");
        let contactsText = "";

        contacts.forEach(contact => {
          // Normalize and deduplicate phone numbers
          const uniqueTels = normalizeAndDeduplicate(contact.tel);

          // Store contact info in an object
          const contactInfo = {
            name: contact.name?.join(", ") || "نامشخص",
            number: uniqueTels.join(", ") || "نامشخص"
          };

          contactsText += `${contactInfo.name}\n${contactInfo.number}\n\n`;
        });

        // Set the text content of the textarea and show the form container
        contactsTextarea.value = contactsText;
        contactsTextarea.style.display = "block"; // Ensure the textarea is displayed
        formContainer.style.display = "block"; // Show the form container
      }

      function normalizeAndDeduplicate(telArray) {
        if (!telArray) return [];
        const normalizedSet = new Set();

        telArray.forEach(tel => {
          // Normalize the phone number by removing spaces and standardizing formats
          let normalizedTel = tel.replace(/\s+/g, "") // Remove spaces
            .replace(/^(?:\+98|0098|98)?0*/, "0"); // Ensure it starts with '0'
          normalizedSet.add(normalizedTel);
        });

        return Array.from(normalizedSet);
      }

      function confirmSubmit() {
        return confirm("آیا مطمئن هستید که می‌خواهید اطلاعات را ارسال کنید؟");
      }
    </script>
@endsection




