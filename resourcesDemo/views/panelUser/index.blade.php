@extends('app')
@section('style')
<style>
    #contacts {
        display: none; /* Initially hidden */
        margin-top: 20px;
        width: 100%;
        max-width: 600px;
        height: 300px;
        margin: 20px auto;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        box-sizing: border-box;
        white-space: pre-wrap;
        text-align: center; /* Center text inside */
        direction: rtl; /* Right-to-left text direction for Farsi */
    }

    .form-container {
        display: none; /* Initially hidden */
        margin-top: 20px;
        text-align: center;
    }

    .form-container textarea {
        width: 100%;
        max-width: 600px;
        height: 300px;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        box-sizing: border-box;
        white-space: pre-wrap;
        text-align: center;
        direction: rtl;
    }

    .form-container button {
        margin-top: 10px;
    }</style>
@endsection
@section('content')
{{--    <div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh;">--}}
{{--        <form class="form" action="{{url('make/host')}}" method="post" style="text-align: left">@csrf--}}
{{--            <p class="title text-center">ایجاد مهمان ها </p>--}}
{{--            <p class="message text-right">درصورت تعریف دوبار یک شخص دوبار برای او پیامک میرود</p>--}}
{{--            <label>--}}
{{--                <input required="" placeholder="" name="name" type="text" class="input">--}}
{{--                <span> نام و نام خونوادگی</span>--}}
{{--            </label>--}}
{{--            <label>--}}
{{--                <input required="" placeholder="" name="number" type="number" class="input">--}}
{{--                <span>موبایل</span>--}}
{{--            </label>--}}

{{--            <button class="submit"> ایجاد</button>--}}
{{--            <label style="background: #37b103;border-radius: 10px; padding: 10px; color: #fff; text-align: center" onclick="getContacts()">از مخاطبین</label>--}}
{{--        </form>--}}

{{--    </div>--}}


    <div class="form-container" id="formContainer" style="margin-bottom: 50px; border-radius: 23px;">
        <form id="contactForm" action="{{url('make/group')}}" method="POST">@csrf
            <textarea id="contacts" name="contacts" placeholder="مخاطبین ..."></textarea>
            <br>
            <button type="submit" onclick="return confirmSubmit()" style="background: #37b103;border-radius: 10px; padding: 10px; color: #fff; text-align: center">ایجاد از لیست بالا</button>
        </form>
    </div>
    <!-- Your Table Code Here -->
    <div style="overflow-x:scroll;">
        <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
            <thead class="bg-blue-500 sticky top-0 z-10">
            <tr>
                <th class="py-3 px-6 text-right font-medium text-white uppercase tracking-wider">نام</th>
                <th class="py-3 px-6 text-center font-medium text-white uppercase tracking-wider">موبایل</th>
                <th class="py-3 px-6 text-center font-medium text-white uppercase tracking-wider">کد</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($user->Users->sortBy('to') as $item)
                <tr class="hover:bg-gray-100 cursor-pointer">
                    <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right" onclick="openModal('{{ $item->name }}', '{{ $item->id }}')">
                        <a href="#" class="text-blue-600 hover:text-blue-900">
                            {{$item->name}}
                        </a>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center" onclick="openModal('{{ $item->name }}', '{{ $item->id }}')">{{$item->number}}</td>
                    <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap" onclick="openModal('{{ $item->name }}', '{{ $item->id }}')">{{$item->to}}</td>
                </tr>
                <tr class="spacer">
                    <td colspan="100"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modals -->
    <div id="modal-container" class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4">
        <div id="modal-content" class="bg-white p-4 sm:p-6 rounded-lg shadow-lg max-w-sm w-full relative">
            <h2 id="modal-title" class="text-xl sm:text-2xl font-semibold mb-4 text-center"></h2>
            <p id="modal-body" class="text-gray-700 mb-4 text-center"></p>
            <div class="flex flex-wrap justify-center gap-2">
                <a id="panel-access-link" href="#" class="bg-green-500 text-white rounded p-2" title="Panel Access">
                    ورود به پنل
                </a>
                <button class="bg-yellow-500 text-white rounded p-2" title="Resend Password">
                    ارسال دوباره رمز
                </button>
                <button class="bg-blue-500 text-white rounded p-2" title="Edit" style="width: 44px">
                    <i class="fas fa-edit text-white text-lg"></i>
                </button>
                <button class="bg-red-500 text-white rounded p-2" title="Delete" style="width: 44px">
                    <i class="fas fa-trash text-white text-lg"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
      async function getContacts() {
        if ('contacts' in navigator && 'ContactsManager' in window) {
          const properties = ['name', 'tel'];
          const options = { multiple: true };

          try {
            const contacts = await navigator.contacts.select(properties, options);
            displayContacts(contacts);
          } catch (error) {
            alert('دسترسی به مخاطبین رد شد یا امکان‌پذیر نیست.');
            console.error(error);
          }
        } else {
          alert('مرورگر شما از API مخاطبین پشتیبانی نمی‌کند.');
        }
      }

      function displayContacts(contacts) {
        const contactsTextarea = document.getElementById('contacts');
        const formContainer = document.getElementById('formContainer');
        let contactsText = '';

        contacts.forEach(contact => {
          // Normalize and deduplicate phone numbers
          const uniqueTels = normalizeAndDeduplicate(contact.tel);

          // Store contact info in an object
          const contactInfo = {
            name: contact.name?.join(', ') || 'نامشخص',
            number: uniqueTels.join(', ') || 'نامشخص'
          };

          contactsText += `${contactInfo.name}\n${contactInfo.number}\n\n`;
        });

        // Set the text content of the textarea and show the form container
        contactsTextarea.value = contactsText;
        contactsTextarea.style.display = 'block'; // Ensure the textarea is displayed
        formContainer.style.display = 'block'; // Show the form container
      }

      function normalizeAndDeduplicate(telArray) {
        if (!telArray) return [];
        const normalizedSet = new Set();

        telArray.forEach(tel => {
          // Normalize the phone number by removing spaces and standardizing formats
          let normalizedTel = tel.replace(/\s+/g, '') // Remove spaces
            .replace(/^(?:\+98|0098|98)?0*/, '0'); // Ensure it starts with '0'
          normalizedSet.add(normalizedTel);
        });

        return Array.from(normalizedSet);
      }

      function confirmSubmit() {
        return confirm('آیا مطمئن هستید که می‌خواهید اطلاعات را ارسال کنید؟');
      }
    </script>
@endsection
