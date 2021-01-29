
<template>
  <v-card
    class="mx-auto "
    outlined
    elevation="0"
  >
    <v-list-item>
      <v-card-text>
        <div>
          dd Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, nisi. Quaerat fuga ducimus voluptatibus eius delectus magnam, dignissimos neque, repudiandae, numquam eos iusto? Tenetur, maxime doloribus! Exercitationem ratione deserunt quasi!
        </div>
        <v-divider class="mb-5 mt-5" />
        <div class="d-flex justify-space-around align-center">
          <span>
            <v-avatar
              color="indigo"
              size="30"
            >
              <span class="white--text headline">DS</span>
            </v-avatar> Posted by {{ topic.user.email }}

          </span>
          <span>
            {{ topic.created_at }}
          </span>
          <span>
            50
          </span>
        </div>
      </v-card-text>
    </v-list-item>
  </v-card>
</template>

<script>
export default {
props:{
   topic:{
      type:Object,
      default:null,
    },
},
mounted(){
  console.log(this.topic)
}
}
</script>

<style>

</style>