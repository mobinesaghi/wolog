@extends('app')
@section('content')

    <div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;margin: 90px 0 10px 0 ">
        <form class="form" action="{{url('make/host')}}" method="post" style="text-align: left">@csrf
            <p class="title text-center">ایجاد دعوت کنندگان </p>
            <p class="message text-right">با اضافه شدن هر کاربر دسترسی اضافه کردن میهمانان را دارد</p>
            <label>
                <input required="" placeholder="" name="name" type="text" class="input">
                <span> نام و نام خونوادگی</span>
            </label>
            <label>
                <input required="" placeholder="" name="number" type="number" class="input">
                <span>موبایل</span>
            </label>
            <div class="flex">
                <label>
                    <input required="" placeholder="" name="from" type="number" class="input">
                    <span>از</span>
                </label>
                <label>
                    <input required="" placeholder="" name="to" type="number" class="input">
                    <span>تا</span>
                </label>
            </div>
            <button class="submit">ایجاد</button>
        </form>
    </div>
    <div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;">
        <div class="form" style="width:350px; margin-bottom: 20px; margin-top: 10px;">
            <form class="" action="{{url('list_page')}}" method="post" >@csrf
                <button class="submit"  style="width:310px;">لیست کامل مراسم و ارسال پیامک</button>
            </form>
            <form class="" action="{{url('smsLogs')}}" method="post" >@csrf
                <button class="submit"  style="width:310px;">لیست پیامک های ارسال شده سیستم</button>
            </form>
           <div class="" STYLE="display: flex; justify-content:  center">
               <button id="copyButtonMan" class="submit" style="margin-left: 8px">لیست زنانه</button>
               <button id="copyButton" class="submit">لیست کلی</button>
               <button id="copyButtonWoman" class="submit" style="margin-right: 8px">لیست مردانه</button>
           </div>

        </div>

        <script>
            document.getElementById('copyButton').addEventListener('click', () => {
                navigator.clipboard.writeText("https://jashn.alimontazer.ir/attendance-recorder/{{$user->id}}/{{$user->number}}")
                    .then(() => alert('لینک لیست کلی کپی شد!'))
                    .catch(err => console.error('خطا در کپی لینک:', err));
                navigator.vibrate([200]);
            });
            document.getElementById('copyButtonMan').addEventListener('click', () => {
                navigator.clipboard.writeText("https://jashn.alimontazer.ir/attendance-recorder/{{$user->id}}/{{$user->number}}?gender=womans")
                    .then(() => alert('لینک لیست زنانه کپی شد!'))
                    .catch(err => console.error('خطا در کپی لینک:', err));
                navigator.vibrate([200]);
            });
            document.getElementById('copyButtonWoman').addEventListener('click', () => {
                navigator.clipboard.writeText("https://jashn.alimontazer.ir/attendance-recorder/{{$user->id}}/{{$user->number}}?gender=mans")
                    .then(() => alert('لینک لیست مردانه کپی شد!'))
                    .catch(err => console.error('خطا در کپی لینک:', err));
                navigator.vibrate([200]);
            });
        </script>
    </div>

    <!-- Your Table Code Here -->
    <div class="w-full flex justify-center">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white max-w-[350px]">
            <input type="text" id="searchInput" placeholder="جستجو..." class="p-2  w-full text-right focus:outline-none focus:none" style="padding: 14px;width:350px">
            <!-- Your Table Code Here -->
            <div style="overflow-x:scroll;">
                <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
                    <thead class=" text-black sticky top-0 z-10" style="background: rgba(244,244,244,0.82);border-bottom: 1px solid;border-color: #e1e1e1 ">
                    <tr>
                        <th class="py-3 px-6 text-right font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">نام</th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">موبایل</th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">از</th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">تا</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($user->Users->sortBy('from') as $item)
                        <tr class="hover:bg-red-100 cursor-pointer" onclick="openModal('{{ $item->name }}', '{{ $item->id }}')">
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right" style="color: #000000 !important;font-weight:600 " >{{$item->name}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">{{$item->number}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap" >{{$item->from}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap" >{{$item->to}}</td>
                        </tr>
                        <tr class="spacer">
                        </tr>
                    @endforeach
                    <!-- پیغام تایید و دکمه‌ها -->

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modals -->
    <!-- Modals -->
    <div id="modal-container" class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4">
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


                <form id="panel-access-link-edite" action="#" class=" text-white rounded p-2" title="Panel Access" method="post">@csrf
                    <button class="bg-blue-500 text-white rounded p-2" title="Edit" style="width: 44px">
                        <i class="fas fa-edit text-white text-lg"></i>
                    </button>
                </form>
                <form id="panel-access-link-delete" action="#" class=" text-white rounded p-2" title="Panel Access" method="post">@csrf
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
            document.getElementById('modal-title').innerText = title; // Set modal title
            document.getElementById('panel-access-link-edite').action = `/edit/${id}`;
            document.getElementById('panel-access-link-delete').action = `/delete/${id}`;
            const panelLink = document.getElementById('panel-access-link')
            panelLink.href = `/go_down/${id}`;
            document.getElementById('modal-container').classList.remove('hidden'); // Show modal
        }
        function closeModal() {
            document.getElementById('modal-container').classList.add('hidden')
        }
        document.getElementById('modal-container').addEventListener('click', (e) => {
            if (e.target === document.getElementById('modal-container')) {
                closeModal()
            }
        })
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




