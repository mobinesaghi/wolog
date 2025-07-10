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
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
@endsection
@section('content')
    {{--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

    <div class="w-full flex justify-center" style="  margin: 80px 0 20px 0 ">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white ">
            <div class="container">
                <div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center; width: 350px">
                    <form class="form  w-full" action="{{url('list_page/D_exl/'.$user->id)}}" method="post" style="text-align: left">@csrf
                        <button class="submit ">اکسل</button>
                    </form>
                    <form class="form  w-full" action="{{url('list_page/D_note/'.$user->id)}}" method="post" style="text-align: left">@csrf
                        <button class="submit ">نوت</button>
                    </form>
                    <form class="form  w-full" action="{{url('list_page/D_pdf/'.$user->id)}}" method="post" style="text-align: left">@csrf
                        <button class="submit ">pdf</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="w-full flex justify-center" style="  margin: 0px 0 20px 0 ">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white ">
            <div class="container">
                <div class="container"
                     style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;">
                    <form class="form" action="{{url('list_page')}}" method="post" style="text-align: left">@csrf
                        <div class="flex">
                            <label>
                                <input required="" placeholder="" name="from" type="number" class="input">
                                <span>از کد</span>
                            </label>
                            <label>
                                <input required="" placeholder="" name="to" type="number" class="input">
                                <span>تا کد</span>
                            </label>

                        </div>
                        <button class="submit">فیلتر</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
        <form action="sendMassage" method="post">@csrf

    <div class="w-full flex justify-center">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white max-w-[350px]">
            <div class="" style="display: flex">
                <input type="text" id="searchInput" placeholder="جستجو..."
                       class="p-2  w-full text-right focus:outline-none focus:none" style="padding: 14px;width:350px">
                <label onclick="openModalSms()" class="p-2  w-full text-right focus:outline-none focus:none "
                       style="padding: 14px;background:var(--primary-color);color:var(--text-color);  width:350px;text-align: center">ارسال
                    پیامک</label>
            </div>
            <div id="modal-sms-container"
                 class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4">
                <div id="modal-content" class="bg-white p-4 sm:p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                    <h2 id="modal-sms-title" class="text-m sm:text-2xl font-semibold mb-4 text-center"
                        style="font-size: 16px;font-weight: 500"> %name% را برای جایگزینی با نام استفاده کنید</h2>
                    <h2 id="modal-sms-code" class="text-m sm:text-2xl font-semibold mb-4 text-center"
                        style="font-size: 16px;font-weight: 500"> %code% را برای جایگزینی با کد استفاده کنید</h2>
                    <p id="modal-sms-body" class="text-gray-700 mb-4 text-center"></p>
                    <textarea id="message" name="massage"
                              class="focus:outline-none focus:none border rounded p-2 h-32 w-full border-none rounded-sm bg-gray-200"
                              style="border-radius: 8px" placeholder="پیام خود را وارد کنید."></textarea>
                    <button style="background: var(--primary-color);color: var(--text-color); padding: 12px;border-radius: 12px; margin-right: 43%" id="submitBtn">
                        ارسال
                    </button>


                    <script>
                        document.getElementById('submitBtn').addEventListener('click', function(event) {
                            const checkboxes = document.querySelectorAll('.user-checkbox');
                            const checkedCount = [...checkboxes].filter(chk => chk.checked).length;

                            if (!confirm(`تعداد ${checkedCount} مهمان انتخاب شده‌اند. مطمئنی که می‌خواهی ادامه بدی؟`)) {
                                event.preventDefault(); // Stop if not confirmed
                                return;
                            }
                            this.textContent = 'در حال ارسال...';
                        });


                        document.getElementById('modal-sms-title').addEventListener('click', () => {
                            navigator.clipboard.writeText("%name%").then().catch(err => console.error('خطا در کپی لینک:', err));
                            navigator.vibrate([200]);
                        });
                        document.getElementById('modal-sms-code').addEventListener('click', () => {
                            navigator.clipboard.writeText("%code%").then().catch(err => console.error('خطا در کپی لینک:', err));
                            navigator.vibrate([200]);
                        });
                    </script>

                </div>
            </div>


            <!-- Your Table Code Here -->

            <div style="overflow-x:scroll;">
                <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
                    <thead class=" text-black sticky top-0 z-10"
                           style="background: rgba(244,244,244,0.82);border-bottom: 1px solid;border-color: #e1e1e1 ">
                    <tr>
                        <th class="py-3 px-6 text-right font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">
                            <i id="checkAllBtn" class="fas fa-check text-black"></i>


                        </th>
                        <th class="py-3 px-6 text-right font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">نام
                        </th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">موبایل
                        </th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">کد
                        </th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">معرف
                        </th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                            style="color: #2c2c2c">پیام ها
                        </th>

                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($allUsers->sortBy('to') as $item)

                        <tr class="hover:bg-red-100 cursor-pointer"
                            @if($item->from > 11)
                                style="background: rgba(255,232,123,0.4)"
                        @else
                        @endif
                        >
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">
                                <input type="checkbox" name="ids[]" class="user-checkbox" value="{{ $item->id }}">
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right" style="color: #000000 !important;font-weight:600 "
                                @if($item->from > 11)
                                onclick="openModal('لطفاً توجه داشته باشید که فردی با نام {{$item->DFrom->name}}، کد {{$item->DFrom->to}} و شماره {{$item->DFrom->number}} قبلاً ثبت شده است. برای تأیید و یا ویرایش اطلاعات،ویرایش پایین را بزنید.' , '{{ $item->id }}')"
                                @else
                                    onclick="openModal('{{ $item->name }}', '{{ $item->id }}')"
                                @endif
                            >{{$item->name}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">{{$item->number}}</td>

                            @if($item->type == 3)
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{$item->to}}</td>
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{$item->user8D->name}}</td>
                            @else
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap"></td>
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap"></td>
                            @endif

                            <!-- جدول -->
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">
                                <label id="uniqueOpenMessageModal" onclick="openMessageModal('{{ $item->id }}masagesModal')" class="text-blue-500 hover:text-blue-700 cursor-pointer">
                                    {{ $item->massages->count() }}
                                </label>
                            </td>

                            <!-- مدال -->
                            <div id="{{ $item->id }}masagesModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden" style="z-index: 100">
                                <div class=" bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                    <h3 class="text-lg font-semibold mb-4">پیام‌ها</h3>
                                    <div id="uniqueModalMessages" class="mb-4 overflow-y-auto h-[70vh]">
                                        @foreach($item->massages as $massage)
                                            <div class="" style=" background: #dadada; border-radius: 13px;margin: 10px">
                                                <p style="padding: 10px">
                                                    {{ $massage->sms }}
                                                </p>
                                                <p style=" padding: 10px">
                                                    {{ $massage->updated_at->format('H:i') }}
                                                </p>
                                            </div>

                                        @endforeach
                                    </div>
                                    <label onclick="closeMessageModal('{{ $item->id }}masagesModal')" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">بستن</label>
                                </div>
                            </div>
                            <script>
                                function openMessageModal(modalId) {
                                    document.getElementById(modalId).classList.remove('hidden');
                                }

                                // تابع برای بستن مدال
                                function closeMessageModal(modalId) {
                                    document.getElementById(modalId).classList.add('hidden');
                                }
                            </script>



                        </tr>
                    @endforeach

                    <!-- پیغام تایید و دکمه‌ها -->

                    </tbody>
                </table>
            </div>

        </div>

    </div>
        </form>


    <!-- Modals -->
    <div id="modal-container"
         class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4">
        <div id="modal-content" class="bg-white p-4 sm:p-6 rounded-lg shadow-lg max-w-sm w-full relative">
            <h2 id="modal-title" class="text-m sm:text-2xl font-semibold mb-4 text-center"
                style="font-size: 18px;font-weight: 500"></h2>
            <p id="modal-body" class="text-gray-700 mb-4 text-center"></p>
            <div class="flex flex-wrap justify-center gap-2">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('checkAllBtn').onclick = () => {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            const allChecked = [...checkboxes].every(chk => chk.checked);
            checkboxes.forEach(chk => chk.checked = !allChecked);
        };
        document.addEventListener('DOMContentLoaded', function () {
            // Get the search input and table rows
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tr.hover\\:bg-red-100');

            // Add event listener to the search input
            searchInput.addEventListener('keyup', function () {
                const filter = searchInput.value.toLowerCase();

                // Loop through the rows to filter based on the input
                tableRows.forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    let textContent = '';

                    // Combine text content of all cells in a row
                    for (let cell of cells) {
                        textContent += cell.textContent.toLowerCase();
                    }

                    // Show or hide the row based on the filter match
                    if (textContent.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        function openModalSms() {
            // document.getElementById('modal-title').innerText = title; // Set modal title
            document.getElementById('modal-sms-container').classList.remove('hidden'); // Show modal
        }

        function openModal(title, id) {
            document.getElementById('modal-title').innerText = title; // Set modal title
            // document.getElementById('panel-access-link-edite').action = `/edit/${id}`;
            // document.getElementById('panel-access-link-delete').action = `/delete/${id}`;
            document.getElementById('modal-container').classList.remove('hidden'); // Show modal
        }

        function closeModal() {
            document.getElementById('modal-container').classList.add('hidden')
            document.getElementById('modal-sms-container').classList.add('hidden')
        }

        document.getElementById('modal-container').addEventListener('click', (e) => {
            if (e.target === document.getElementById('modal-container')) {
                closeModal()
            }
        })
        document.getElementById('modal-sms-container').addEventListener('click', (e) => {
            if (e.target === document.getElementById('modal-sms-container')) {
                closeModal()
            }
        })

        async function getContacts() {
            if ('contacts' in navigator && 'ContactsManager' in window) {
                const properties = ['name', 'tel'];
                const options = {multiple: true};

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
