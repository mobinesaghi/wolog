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


    <form action="sendMassage" method="post">@csrf
    <div class="w-full flex justify-center " style="margin-top: 90px">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white max-w-[350px]">
            <div class="" style="display: flex">
                <input type="text" id="searchInput" placeholder="جستجو..."
                       class="p-2  w-full text-right focus:outline-none focus:none" style="padding: 14px;width:350px">
            </div>


            <!-- Your Table Code Here -->

                <div style="overflow-x:scroll;">
                    <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
                        <thead class=" text-black sticky top-0 z-10"
                               style="background: rgba(244,244,244,0.82);border-bottom: 1px solid;border-color: #e1e1e1 ">
                        <tr>
                            <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">موبایل
                            </th>

                            <th class="py-3 px-6 text-right font-medium text-black uppercase tracking-wider"
                                style="color: #2c2c2c">پیامک
                            </th>

                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($messages = $messages->reverse() as $item)
                            <tr class="hover:bg-red-100 cursor-pointer" >
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">{{$item->receiver}}</td>
                                <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right" style="color: #000000 !important;font-weight:600 ">{{$item->sms}}</td>

                            </tr>
                        @endforeach
                        <!-- پیغام تایید و دکمه‌ها -->

                        </tbody>
                    </table>
                </div>

        </div>

    </div>
    </form>

    
@endsection
@section('script')
    <script>
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

        function openModal(title, id) {
            document.getElementById('modal-title').innerText = title; // Set modal title
            // document.getElementById('panel-access-link-edite').action = `/edit/${id}`;
            // document.getElementById('panel-access-link-delete').action = `/delete/${id}`;
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
