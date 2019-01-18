<template>
    <div>

        <div :key="record_id" :id="'record-'+record_id" :class="'level-'+level" class="comment rounded card bg-light">

            <div class="card-body comment-text">
                <h3 class="card-title">
                    {{ full_name  }}
                </h3>
                <div class="card-text">
                    {{ comment }}
                </div>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <a href="#" v-on:click="replyTo(record_id)">
                            Add Reply
                        </a>
                    </div>
                    <div class="col-6 text-right">
                        Posted on <span>{{ created_at  }}</span>
                    </div>
                </div>
            </div>
        </div>

        <comments-tree
            v-for="item in children"
            :children="item.children"
            :full_name="item.full_name"
            :comment="item.comment"
            :created_at="item.created_at"
            :level="item.level"
            :key="item.id"
            :record_id="item.id">
        </comments-tree>

    </div>
</template>

<script>
    export default {
        props: ['record_id', 'full_name', 'children', 'created_at', 'comment', 'level', 'parent_id'],
        name: "comments-tree",
        methods: {
            replyTo: function(parent_id_to_use){

                this.$root.parent_id = parent_id_to_use;
                this.$root.parent_poster_name = jQuery("#record-" + parent_id_to_use + " .card-title").text();

            }
        }
    }
</script>

<style scoped>

</style>
