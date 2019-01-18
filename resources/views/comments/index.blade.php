@extends('layouts.tmbc')

@section('title', 'Website Comments')

@section('content')

    <div id="main-content">

        <h1 class="text-center">Website Comments</h1>

        <div id="add-comment-form">

            <div class="card rounded bg-light">
                <div class="card-body">
                    <h2 class="card-title">
                        Add New Comment
                    </h2>

                    <form>

                        <div v-if="parent_id" class="form-group">
                            <p>
                                Replying to: @{{ parent_poster_name }}
                            </p>
                        </div>

                        <div class="form-group">
                            <input v-model="full_name" type="text" class="form-control" id="form-full-name" placeholder="Your Full Name">
                        </div>

                        <div class="form-group">
                            <textarea v-model="comment" class="form-control" id="form-comment" rows="3" placeholder="Type your comments here."></textarea>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-primary" @click="submitForm">Save Comment</button>
                        </div>

                        <div v-if="errors.length">
                            <strong>Please correct the following error(s):</strong>
                            <ul>
                                <li v-for="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <hr>

        <div id="spinner" class="text-center" v-show="spinner">
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading comments...</span>
            </div>
        </div>

        <comments-tree :id="comments.id" :full_name="comments.full_name" :children="comments.children"></comments-tree>

        <footer>
            <div class="text-center">
                &copy; 2019 Roosevelt Purification. All Rights Reserved.
            </div>
        </footer>

    </div>

@endsection
