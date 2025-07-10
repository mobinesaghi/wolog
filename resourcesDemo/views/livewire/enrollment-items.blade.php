<div>

    <tr>
        <td>{{$thisuser->name}}</td>
        <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEnrollment{{$thisuser->id}}">
                {{$thisuser->id}}
            </button>
        </td>
        <td>{{ mSh($thisuser->updated_at)}}</td>

        <td>
            <!-- Button modal edit-->

            <button class="btn btn-success" onmouseenter="document.getElementById('sidebarForm').action='startclass/{{$thisuser->id}}'" onmousedown="document.getElementById('sidebarForm').submit();">شروع کلاس</button>
            <button class="btn btn-warning" onmouseenter="document.getElementById('sidebarForm').action='startclass/{{$thisuser->id}}'" onmousedown="document.getElementById('sidebarForm').submit();">ویرایش</button>
            <button class="btn btn-danger" onmouseenter="document.getElementById('sidebarForm').action='startclass/{{$thisuser->id}}'" onmousedown="document.getElementById('sidebarForm').submit();">حذف</button>
        </td>
    </tr>
    <!-- Modal edit-->
    <div class="modal fade" id="editEnrollment{{$thisuser->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$thisuser->title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('editUser')}}" method="post">@csrf
                    <div class="modal-body" style="text-align: center" dir="rtl">
                        <input type="hidden" name="id" value="{{$thisuser->id}}">

                        <div class="row">
                            <div class="col">نوع کاربری :</div>
                            <div class="col">
                                <select name="type" id="type{{$thisuser->id}}Select">
                                    <option value="user">ساده</option>
                                    <option value="client">دانشجو</option>
                                    <option value="admin">معلم</option>
                                </select>
                                <script>document.getElementById('type{{$thisuser->id}}Select').value ='{{$thisuser->type}}';</script>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">کد ملی :</div>
                            <div class="col">
                                <input type="number" name="name" value="{{$thisuser->name}}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">موبایل دانشجو :</div>
                            <div class="col">
                                <input type="number" name="phone" value="{{$thisuser->phone}}">
                            </div>
                        </div>

                        <hr>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal make class-->


</div>
