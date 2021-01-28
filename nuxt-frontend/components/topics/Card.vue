<template>
  <div>
    <v-card
      color="#FFFFFF"
      class="mx-auto "
      outlined
      elevation="1"
    >
      <v-list-item>
        <v-card-text>
          <v-card-title class="mb-4 mr-0 pr-0 font-weight-bold">
            {{ topic.title }}
          </v-card-title>
          <div>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, nisi. Quaerat fuga ducimus voluptatibus eius delectus magnam, dignissimos neque, repudiandae, numquam eos iusto? Tenetur, maxime doloribus! Exercitationem ratione deserunt quasi!
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
  </div>
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