@extends('stu.stu')

@section('content')
<!-- Page Content  -->
<div v-cloak id="content" class="p-4 p-md-5 pt-5 all_content">
    <div v-if="status == 0">
        <div v-for="branch in all_branch" class="col-md-3 right">
            <div class="branch_item" @click="show_dars(branch.id,branch.type)">
                <img src="/as/images/school.png" alt="">
                <h3 class="h3_branch">@{{branch.name}}</h3>
            </div>
        </div>
    </div>
    <div v-if="status == 1">
        <div v-for="lesson in all_lesson" class="col-md-3 right">
            <div class="branch_item" @click="show_film(lesson.id)">
                <img src="/as/images/computer.png" alt="">
                <h3 v-if="lesson.l_name" class="h3_branch">@{{lesson.l_name}}</h3>
                <h3 v-if="lesson.name" class="h3_branch">@{{lesson.name}}</h3>
            </div>
        </div>
    </div>
    <div v-if="status == 2">
        <div v-if="!message" v-for="film in all_film" class="col-md-3 right">
            <!-- v-if="film.time_added > (new Date().getTime()/1000 - film.limit_time*3600)" -->
            <div class="branch_item" @click="play_film(film.film_id)">
                <img src="/as/images/film.png" alt="">
                <h3 v-if="film.film_id" class="h3_branch">@{{film.title}}</h3>
            </div>
        </div>
        <div v-if="message" style="text-align: center;">
            @{{message}}
        </div>
    </div>
    <div v-if="status == 3">
        <div class="col-md-12 right p_video">

            <!-- <div class="branch_item"> -->
                <video oncontextmenu="return false;" id="myVideo" controlsList="nodownload" controls autoplay @ended="onEnd()">
                    <source :src="'/images/'+film_addr" type="video/mp4">
                </video>
                <div class="content2">
                    <h1>@{{name}}/@{{username}}</h1>
                    <!-- <button id="myBtn" onclick="myFunction()">Pause</button> -->
                </div>
            <!-- </div> -->
        </div>
        
    </div>
</div>
@endsection