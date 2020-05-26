@extends('teacher.teacher')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5 all_content">
    <div class="col-md-12 all_pro right">
        <table v-if="teacher_class.length" class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <th>ردیف</th>
                <th>شعبه</th>
                <th>پایه</th>
                <th>رشته</th>
                <th>درس</th>
            </thead>
            <tbody>
                <tr v-for="classes in teacher_class">
                    <td>@{{classes.id}}</td>
                    <td>@{{classes.b_name}}</td>
                    <td>@{{classes.p_name}}</td>
                    <td v-if="classes.r_name">@{{classes.r_name}}</td>
                    <td v-if="!classes.r_name">عمومی</td>
                    <td>@{{classes.l_name}}</td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
@endsection