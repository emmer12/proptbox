<template>
  <div>
            <div class="card p-card">
              <div class="user-action" v-show="user && user.id==list.user.id"> 
                  <ul class="drop" :id="'drop'+list.id">
                     <li @click="editShow(list.id)">Edit</li>
                     <router-link :to="{name:'boost',params:{id:list.id}}" tag="li">Boost</router-link>
                     <li @click="deleteList(list.id)">Delete</li>
                  </ul>
                  <div class='btn' >
                    <i class="fa fa-ellipsis-v" @click="showDrop" :data-id="list.id"  aria-hidden="true"></i>
                  </div>
              </div>
              <div class="boosted" v-if="list.boosted">
                Boosted 
              </div>
              <router-link :to="{name:'list-details',params:{id:list.id}}" tag="div" class="img">
                <img :src="list.images ? '/uploads/listing/'+list.images[0] : '/images/'+ 1 +'.jpg'" width="100%"/>

                <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {{list.space_location }}</div>
              </router-link>

              <div class="details">
                  <div class="title">
                    <h4>{{ list.space_type }}</h4>
                    <button v-if="list.id%2==0" class="btn btn-success btn-sm">For {{ list.space_for }}</button>
                    <button v-else class="btn btn-primary btn-sm">For {{ list.space_for }}</button>
                  </div>
                  <div class="l-p">
                     <h4 v-if="list.space_address.length>20">{{list.space_address.substr(0,20) + '...' }}</h4>
                     <h4 v-else>{{list.space_address}}</h4>
                    <h5>&#8358;{{list.rent}}</h5>
                  </div>
                  <div class="description">
                     <p v-if="list.about_property.length>70">{{list.about_property.substr(0,70) + '...' }}</p>
                     <p v-else>{{list.about_property}}</p>
                  </div>
                  <hr>
                  <div class="c-t-a">
                        <div class="verified"  v-if="list.user.id_verified_at && list.user.phone_verified_at && list.user.email_verified_at">
                         <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="25" height="25" fill="url(#pattern0)"/>
                            <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0" transform="scale(0.00195312)"/>
                            </pattern>
                            <image id="image0" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALbgAAC24BLbeFvAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAACAASURBVHic7N13lCXpXd//903dPZ1zT/eEmt2dWa2ySzIZY0lwbET4EQxGkpWQhMgSChZw4FfG1xYGBMokgZAEC5IlwAJs/Ds2ByMJMCCku5LQhtnZ2a6Z6ZxzuOn3R92e6Z253dPd9VS4dT+vc+bspH7q2e7p+/3c53nqW6lqtYqINAcrX7CANwD/HHhG7bcfAT4HvNd17CejmpuIhCulACCSfFa+0A/8AvBqIHfAXysCHwF+0nXsxZCmJiIRUQAQSTgrX/iXwIPA2SN+yA3g5a5jfyq4WYlI1BQARBLKyhcywH8AfgZIH/PDK8DPAz/nOnbZ9NxEJHoKACIJVNvr/wPga30O9bfAy1zHdv3PSkTi5LjvCkQk5qx84XuBh/Bf/KmN8QUrX/i3BsYSkRjRCoBIQlj5QjvwHuB1AV3ig8AbXMfeDGh8EQmRAoBIAlj5wnOBjwEPBHypx4CXuI79UMDXEZGAaQtApMFZ+cIbgL8n+OIP8DTg76x84Y0hXEtEAqQVAJEGZeULg8CHgW+NaAp/Drzadey5iK4vIj4oAIg0ICtf+Ebg94DRiKcyDbzCdey/iHgeInJMCgAiDcTKF3LAfwLeBqQins6eKvAO4Gddxy5GPRkRORoFAJEGYeUL9wIfBb4y6rkc4LPAS13HfiLqiYjI3ekQoEgDsPKFlwEF4lv8Ab4CKFj5wsujnoiI3J1WAERizMoXOoFfBV4Z9VyO6UHgR1zHXot6IiJSnwKASExZ+cLz8Zb8L0U9lxN6Am9L4LNRT0RE7qQAIBIzVr6QAt6C9zCegx7d2yiKwM8C73AdWy82IjGiACASI1a+MAJ8BPjXUc/FsL/Au11wOuqJiIhHhwBFYsLKF74Z+CIhFf+O1lN0tJ4K41IA3wR80coXviWsC4rI4bQCIBIxK19oAf4L8CZCurd/tHcYq38MAHdxkqnl2TAuu+fdwE+5jr0T5kVF5KkUAEQiZOULl/Ae4vO8MK6Xy2S5OGzR2979lN9f3lzlyqxLsVwKYxrgPa74Ja5jPxbWBUXkqRQARCJi5QuvBt4HdIZxvd72Li4OXyCXydb982K5xJXZcZY3Q7tzbwN4o+vYHwzrgiJyiwKASMisfKEb+A3gpWFcL5VKcb5/jLHe4SP9/cnlWa4tThLia8PHgde7jr0S1gVFRAFAJFRWvvBVePf23xPG9dpyrdw/coGO1vZjfdzGziaXZ8bZLoa2Te8CL3Md+2/DuqBIs1MAEAmBlS+kgZ8E8kD9NXjDhrr6uWfwHJn0yW72KVcqPDl/nbm1RcMzO/iSwM8BP+86diWsi4o0KwUAkYBZ+cIY3qN7XxTG9TLpDPcOnWOws8/IePPrS1ydu065UjYy3hF8Cni569g3wrqgSDNSABAJkJUvfDvwO8BgGNfrbOvg0rBFW67V6LjbxR0en3VZ394wOu4hFoHXuo79ybAuKNJsFABEAmDlC63AO4AfD+uaZ3pHONc/SioVTCuBarXK9cUpJpZnAhn/AL8OvNl17O0wLyrSDBQARAyz8oWn493b/5wwrteSzXFx2KLnVFcYl2Nla40rsy67pWIo1wP+Ce+hQv8U1gVFmoECgIhBVr7wA3id7o537P6E+tp7uDh8nuwB9/YHpVQucWX2Gkubod25t423EvDrYV1QJOkUAEQMsPKFXuC3gO8J43rpVApr4Ayne4bCuNyBplfmcBcmqIT3OvJJvLMBod2aIJJUCgAiPln5wtcBfwCcD+N6p1rauH/kAu0toT3I51Cbu1tcnhlnaze0bfobeHcJfCqsC4okkQKAyAlZ+UIG+BnAATJhXHOke5ALg2dIp+L1IM9KtcL4/AQzq/OhXRL4eeDnXMcO7f5EkSRRAGhytSL2r4HvBoaAHmAHmAQmbvsxCcyoSQtY+cI54EHgG8K4Xjad4d7h8wx09IZxuRNb2Fjm6uw1SuH1DPhbvA6CblgXjKtas6lh4AwwVvvvmX2/PgUsA/N4Wyn/03Xs0J7+JPGjANDErHzhu/EeRjN2jA8rAdPcCgS3B4QJYMJ17NCeKBM2K1/4LuCDgJlOO3fR1dbJpRGL1mxLGJfzbae0y+MzLmvb62FdcgXvWQIfD+uCYbPyhU6eWszPcGeBH+V4XSangTe5jv0xs7OVRqEA0ISsfCEFvB346QAvs8ZdQgIw3UjvQKx84RTwTuCHwrheihRn+kY423+aFMHc2x+UKlVuLE4zsTRDldBeYz6I93TB0LoV+VVbgTvNncX89l93HzSGAb8CvE0re81HAaAJWfnCDwO/FvU88PZxZzk4IOytJixHNsMaK194Nt5DfJ4ZxvVasy1cGrHoagvlScGBWdte5/EZl53SbliXfAx4ievYD4V1wYPU7gypV8z3/3oEiMOBjje7jv2uqCch4VIAaDJWvnAer7FKOF1jzNjkqcGg3qrCpOvYgVQZK1/4Ebx3SW1BjH+7gY5e7h0+TzYdyrnCwJUqZa7OXmNhI7QctwP8FPAe17GNv8BZ+UIOr5AftBS/9/NQekEYsgk8x3XsJ6KeiIRHAaDJWPnCR4BXRj2PAFTxDjcdFhImXMc+8jF1K18YwFtW/g7js60jnUpzYfAMI92hPDYgdDOr84zPT1CphrbS/OfAq13HnjvqB9S+5octxZ/BOyzbWHsyR/Nx17G/L+pJSHgUAJqIlS+MAuNAY5wmC8beHQ6HnU2YBL4K75T/mTAm1d5yivtHLnCqJZRFhshs7W5zeWaczd2tsC45jRd4P8NTC/pB797NPkWpsZSB+3RHRfMIt3+oRO3HaO7iD94L/D21H7FwumcIa+AM6YAe4hMnp1raePbZp+EuTDC9cuQ35n6cBv5XGBdKgAzwBuAtUU9EwqEVgCZh5QvtwHWgP+q5iCebyXJx6Dx9HT1RTyUSSxsrXJm7RqncMDeCNINV4GySb+OVW+Jw+lTC8SpU/GOj51QXzz37QNMWf4C+jh6ee/aB0J5iKEfSDbwu6klIOLQC0ARq9/0/Ctwf9VyaXSqV4lzfKGf6RqKeSqxMLM1wfWkKvR7FwjhwUS2Wk08rAM3h21Dxj1xbrpVnjV1S8a/jTN8Izxq7RFuumc/gxcYF4LuinoQETwGgObw56gk0u8HOPp5z9ml0tnVEPZXY6mzr4Dlnn8ZgZygdluVwes1oAtoCSDgrX7CBz0c9j2aVSae5Z/AcQ106fnEcc2uLPDl/nXJF3Wkj9DWuY/9d1JOQ4GgFIPneFPUEmlVHazvPOfuAiv8JDHX185yzD9DR2kjN9BJHqwAJpxWABLPyhTG8Az25iKfSdMZ6hznfP0aqCe7tD1K1WuXa4iSTy7NRT6UZqTFQwmkFINl+DBX/UOUyWZ4+ehFr4IyKvwGpVApr4AxPH71ILqO+ZSHLAG+MehISHK0AJJSpxj8pUlwauUC5Wma3VPR+lGv/Le1SVBOXm3rbu7k4bKlQBaRYLnFl1mV5czXqqcRGLpOlJZujJdPi/TeboyWTI5vJcHlm3MRtlavAOdex9UlPIL1SJderMdD4p7+zl4HO3gP/vFqt3goEN4OBFw72/34lwYe5UqkUVv8Yo73DUU8l0bzVlfuYWp7FXZxMdM+AdCr9lILu/bxl38+93z9slWmws4+5tUW/U+kGXgvoUcEJpBWABKo1/nkMuOR3rGefud/IrWvlSvnOkFDe3RcYvD9rNG25Vu4fuaDDaiHb2Nnk8sw428WdqKdybC2ZHLl9Rbx1r7hnc+RqBd7Eo6A3drb44o1HDcxYjYGSSisAyfTtGCj+XW0dxu5bz6QznGrJcIqDn3ZXpUqxVKqFhN06qwpeaIjLrWHDXQPcM3iWdFpHacLW0drOc88+wJPzN5hdW4h6OoB3y6f3Dr3ltnfuuZu/n8tkQzsb0tF6ip5Tnaxsrfsd6gLw3cAnfE9KYkUBIJmM3L4z2hPuknaK1M0XTA55R12uVA4OCeVbZxOCWt3KpDPcO3RODWsilk6nuW/4PD3tXVydu065Eswb1BQpctnswcW9tgefiWEQHO0dNhEAwHtNUQBIGG0BJIyVLzwP+JzfcVqzLdjWM0jRuCfZ94JBsRYMdkq3QkOx9melYxSNVCrFUFc/Z/tO05pt9qcqx8tOaZeJpWnm1hapHOM1LZPO1Hm33nLH/nsje+jaw2yZ2Sr5Wtex/6+JgSQetAKQPEYa/4z2DjV08Qdvr7Ulk4ND2stXqpW6dzfslosUyyUyqTS5TI7WXAvDXQMNXwySqjXbwr1D5znbN8rs2gI7RW8VqFwtk0tn971bb/G+nrXi3gzbN6O9w1ydu25iqDcBCgAJohWABLHyhTPAk/i89z+TzvB861mxXNIUkeOpVCt8zv0yJf+37JbxDgOO+5+VxIFe4ZPFSOOfke4BFX+RhEin0ox0D5oYKgO8wcRAEg96lU8IK1/oAH7Q7zgpUpzuGTIwIxGJi9M9g6buPnitlS90mxhIoqcAkByvBnwfS+/v7NUBN5GEacnkTN210g28zsRAEj0FgASw8oU08BMmxhrTu3+RRDLYqfINVr7gv1ORRE4BIBm+HbjodxCTjX9EJF46Wk7Rc6rLxFAWXmMgaXAKAMlgpvGPetmLJJrB73EjrzkSLQWABmflC88HvsHvOK25Fvo7egzMSETiqq+9m1O5QxpjHN1XW/nC15gYSKKjAND4DLX9bfzGPyJyd1oFkD0KAA3MyhfOAt/rd5xMOsNwl5H7hEUk5oa6+slmjDSB/S4rX7hgYiCJhgJAY1PjHxE5FsONgd5oYiCJhl71G5Sxxj8pNf4RaTZqDCSgANDIvh/o9TtIf4ca/4g0G4ONgbpQY6CGpQDQgNT4R0T8UmMgUQBoTP8PcJ/fQdT4R6R5GW4M9G9MDCThUgBoTGr8IyK+6ZbA5qYA0GCsfOGfA//C7zhq/CMiBhsDfZWVL3ytiYEkPAoAjcdQ459hNf4REZOrAG8yNZCEQwGggZht/DNgYEYi0ugMNwa6x8RAEg4FgMby44Dv71Q1/hGRPYYbA73BxEASDlWBBmHlC53A6/2Oo8Y/InK7UTUGakoKAI1DjX9EJBA5s42BfsDEQBI8BYAGUGv8Y6Tn9phu/ROROtQYqPkoADSG78BU45/WdgPTEZGkMdgY6DxqDNQQFAAag5Fb//TuX0QOo8ZAzUUBIOasfOErgK/3O47X+Mf3EQIRSTCvMVCbiaHUGKgBKADEn7HGPyIidzPaa+wuIa0CxJwCQIxZ+cI54Hv8jqPGPyJyVAYbA32nGgPFmwJAvKnxj4iEKp1Kc9pcYyAjdy9JMFQVYkqNf0QkKqfNNQZ6jZUv6KljMaUAEF+vAXx/46jxj4gcl+HGQK8zMZCYpwAQQ2r8IyJRM/ja8QYrXzByqEDMUgCIp+8E7vU7iBr/iMhJtasxUOIpAMSTGv+ISOTUGCjZFABixsoXvhL4Or/jtOVa1fhHRHwx2BjoK618wffrmpilABA/RpKyTv6LiAlqDJRcCgAxYuULRvbK1PhHRExRY6DkUgCIlzegxj8iEiMGGwMZu7tJzFCViAkrXzByv2wqlWJUy/8iYpDBxkCvVWOg+FAAiA8jjX8GOnppUeMfETHIYGOgTuAHTAwk/ikAxICVL+QwtDRm8LYdEZGbDN5W/OO11zyJWKparUY9h6ZVWwr7AbyH/pz3O15XWyfPOnPJ97xEROp5ePIKK1trJoZ6EngP8DuuYxsZUI5PASACtZOwb8Rb9jfSagvgaafv0b3/IhKYpc1VHp16wuSQK8BvA+91HfuayYHl7hQAQmTlC1+Ddy/sd+E9KtOYtlwr9vlnmBxSROQOD117hK3itulhS8AfAe90HfsfTA8u9SkABMzKFzLAd+MV/q8O6joXBs/q9L+IBG5mdZ6rc9eDvMTfAO8EPuk6diXICzU7BYCAWPlCN/BavKV+K8hrZdIZnm89S/f+i0jgKtUKn3O/TKlcCvpSV7l1TmA96Is1IwUAw6x8wcJr6PM6oDuMa471DmMNnAnjUiIiXF+c4sbSdFiXWwE+ALzPdexAlx6ajQKAIVa+8FV4y/z/BsP7+4dJpVI87/wzdO+/iISmWC7yOffLhFw/SsAf4p0T+GyYF04qBQAfavv734lX+L82ijkMdvZxaeRCFJcWkSZ2ZdZlbm0xqsv/Nd45gT/ROYGTUwA4gVrb3tfg7e9H+nCLZ599Gp2t7VFOQUSa0ObuFl+4/mjU03gC75zAh3RO4PgUAI7ByhfO4e3v/wAG2vb61XOqi2eMXYx6GiLSpB6deoKlzdWopwGwzK1zAjeinkyjUAA4Aitf+Aq8Zf7vwcDT+kzIpNM899zTadXev4hEZLe0y0PXH6VcKUc9lT0l4BN45wT+MerJxJ0CwAGsfCENfAde4f/6iKdzh/uGzzPcNRD1NESkyc2tLXJl1o16GvV8Bu+cwJ/qnEB9CgC3sfKFDm7t798X8XTukElnuGfwLENd/VFPRUQE8ELAk/M34rQSsN8TwLvxzglsRD2ZOFEAqLHyhbN4D+V5PRDLhvp97d3cO3ROt/yJSOzslna5Onc9LmcC6lkGfhN4v84JeJo+AFj5wvPxlvm/F4jdIypTqRSDnX2M9Q7T3nIq6umIiBxqc3eLyeVZ5teXwu4TcFRFbp0T+FzUk4lSUwaA2v7+t+MV/m+IeDp1ZTNZTncPcrpnkFwmdrlERORQxXKR6ZV5plfnw2gbfFKfxjsn8GfNeE6gqQKAlS+0A68GfgK4FO1s6juVa2W0d5ihrn7SKfX2F5HGVqlWmFtbZGp5LoinCJpyBe+cwIeb6ZxAUwQAK18YA34M+CGgL+Lp1NVzqovR3mH62kN5fICISOiWNleZWp5lZWst6qkcZIlb5wQmop5M0BIdAKx8wQbeBLyEGO/vj/YM09Gq/X0RaQ4bu1tMxf+cwH8F3uU69uejnkxQEhcArHwhBXwr3v7+CyOeTl3ZdIaRnkFO9wzRov19EWlSu+Ui0ytzzKwuxPmcwKe4dU4gUQUzMQHAyhdOAa/Ce8d/f8TTqast18qY9vdFRJ5i75zA5PIs28WdqKdzkMe5dU5gM+rJmNDwAcDKF0aBH8Xb349la7zuU52M9QzT1xH54wNERGJtaXOldk4gts/2WeTWOYHJqCfjR8MGACtfeC7eu/2XArHrjJNKpRjo6GWsd5gOPa1PRORYNna2mFqJ/TmBj+GdEyhEPZmTaKgAUNvffzHe/v43RjydurLpDCPdtf39rPb3RUT82C0VmV6dY2ZlnlI8Ww0D/BXeOYH/3kjnBBoiANT291+B947/gYinU1dbrpXRniGGuwZIp7W/LyJiUqVaYXZ1kamVWJ8TuIx3TuAjjXBOINYBwMoXRvD2938YGIx4OnV1t3Uy2jtMv/b3RURCsbSxwuTKLKvxPifwG3jnBKainsxBYhkAag/myQMvA1ojns4d9vb3R3uH6dT+vohIJDZ2NplcnmVhYzmu5wR28c4JOK5jx+6ZybEKALUe/T8KvB3oing6d8imMwx3DzDaM6Qn8omIxMRuaa+fQGzPCawDP4O3IhCbZw5ko57AbX4JeEvUk7hdW66V07X9/Yz290VEYqUlm+P8wBhn+04zu7bA1Mpc3M4JdALvAS7gHWKPhdisAFj5wkuAj0Y9j/262joY6x2mv6M36qmIiMgxLG54/QRWt2N3TuBVrmP/btSTgJgEACtfyALXgdNRzyWVStFfu39f+/siIo1tfWeTqXidE1gAxlzH3o16InHZAngxERf/TDrDSPcAp3uGaNX+vohIInS2tnNp5AJWqcjUyiyzqwtRnxMYAL4D+ESUk4D4BIDvjOrCrdkWRnuHGO4a1P6+iEhCtWRzWANnONs3yuzaAtPRnhP4ThQAbgr9Hv+utg5Ge4bp7+whRSrsy4uISAQy6TSjPUOM9gyxuLHM5PIca+GfE4hFX5u4BIBQuuikSNHf2cNozzBdbR1hXFJERGKqv6OX/o7eKM4JxKJzXFwCQKDrMJl0muHuQUa1vy8iIrfZOydwvrRb6yewQDnYcwKxuEcxLgFgIohBW7MtXn/+7gEy6UwQlxARkYRozbY85ZzA1MosO8VADusHUvOOKy4BwOgzlTvbOhjrGaK/s1f7+yIicix75wRO9wze7Cewtr1h8hJGa95JxSUAGElDe/fva39fRET8SuE992Wgo5f17Q0mV+ZYXF+miu9zAloB2Mf3J+PisMVQV7+JuYiIiDxFZ1sH97d1sNCxzOWZJ/0OF4sAEJcb331/MsqV2DxfQUREEqpcNXI4UAFgH9/7Ibvlool5iIiIHGi3ZKTWxOIMQFwCwAxQ8jPAbinytsoiIpJwCgCG1Z6PPO1nDENfFBERkQMZWG2edx07Fn0AYhEAanztiWgLQEREgmbgzWYs9v8hQQGgqBUAEREJmAJAMHztiZQqZSpV3QkgIiLBqFarFP2vNsdi/x/iFQB8pyKdAxARkaAYKP6gFYC6FABERCS2DNUYBYA6/AcAHQQUEZGAGKoxCgB1+G8GpBUAEREJSJJ6AEC8AoC2AEREJLa0BRAQ17HXgDU/Y+yW1Q1QRESCYWALYBeYNzAVI2ITAGr8NQPSCoCIiATEQI2ZdB3b97OETVEAEBEROQIDz5yJzfI/xC8A+DocobsAREQkKAZqTGwOAEL8AoCvdOR1afL1UEEREZE7lCsVyhXf3Wa1AnAI3QkgIiKxY+iQuQLAIdQMSEREYidptwBC/AKAmgGJiEjsJK0JEMQvABjYAlAvABERMStpbYAhfgFgGvB1ykJbACIiYloStwCyUU9gP9exS1a+MAOMnnSMorYARCQGZtcWWN1aZ2Nni63iNq3ZFjpaT9HZ2sFI9yCZdNzef8lhDASAJdext0zMxZRYBYCaCXwEAJ0BEJEobRV3eGLWZW174ym/v13cYbu4w8L6MtOrc9w3ZNFzqjOiWcpxGVhdjtW7f4jfFgD4PCSxoy0AEYnI3NoiX7z+6B3F/3Y7xV0ennycawuxOhMmhzBwvix2X+w4BgBfKalULlGtxqbVsog0idm1Ba7MulSqRz/GNLE8w/h87N4YSh0GmszF7guduAAAOggoIuGaXVvgidlrJ/rYqZVZxhdiVxtkn2K5aOKNZey+yMkMADoHICIh8VP890wtKwTEWRLvAIB4BgA1AxKRhmCi+O9RCIivJDYBgngGAANbAGoGJCLBMln89ygExFMSmwBBUgOAVgBEJEBBFP89CgHxoy2AkLiOvQxs+hlDAUBEghJk8d+jEBAvBmpKCZg1MBWjYhcAanz9y9ddACIShDCK/56p5VlchYBYMFBTplzH9tXmPghxDQC+DktoBUBETAuz+O+ZVAiIhSQ2AYL4BgB/KwAKACJiUBTFf49CQPQM1JRYfgETGQAq1QqlStnUXESkiUVZ/PcoBETHUD2J5RcvkQEAtAogIv7FofjvUQiIRlLvAID4BgA1AxKRSMWp+O9RCAhfUpsAQXwDgO9/4UXdCSAiJxTH4r9HISBcSW0CBAkOAAZObYpIE4pz8d+jEBAebQGEbwrw9eilHW0BiMgxNULx36MQEA6tAITMdexdYM7PGGoGJCLHEXDxD+S2JC8ExHJ7OTEMrACsuo69bmIupsUyANT4+ldd1AqAiBxRwMX/CvAM4P8EMfjk8oxCQIAMBIDYfnHiHADUDEhEAje3thh08X+h69iXgW9DIaDhGHi6bCyX/yHJAaBcpOrvGIGIJNzc2iJXZt2ghn8Cr/jfAHAdexMvBPxVEBebXJ7hmkKAcQZWkxUATsD/rYClkol5iEgChVD8X7BX/PfUQsC3ElAImFAIMKpULlGp+n4jqQBwAv6bAekgoIjUEUXx37MvBHwqiIsrBJhjqIbE9osR5wCgXgAiYlyUxX9PKCFgMbZ1p2EkuQcAJD4AaAVARG6JQ/Hf4zr2Bl4I+HQQk5lYmmF5czWIoZuGAkB0/AcAbQGISE2civ+eWgj4FgIKAU/MXaOsJ6OeWJKbAEGMA4Dr2AvAjp8xtAIgIhDP4r9nXwj4jNFZ4b0G3liaNj1s0zBQQypAbL8AsQ0ANb42sRQARCTOxX9PLQS8mABCwOpWLJvQNQQD58hmXMeO7RJM3AOA714AItK8GqH479m3EvDXJsbbs7m7TdX/rWxNyUANie3yPyQ9AGgFQKRpNVLx31PrGf+twLypMSvVCju6I+pEDNQQBQAffH3yypUy5UrF1FxEpEE0YvEHsPKFNPBuYNDUmKlUipZsi6nhmka1WqVY9t1MTgHAB983sha1DSDSVBq8+P828P0mxz2VayOdSpkcsikkvQkQxD8A+E5PO9oGEGkaKv536mxrNz1kU0h6DwBoggCgboAizUHF/06ZdIZzfaOmh20KCgDRUzMgEbkrFf/6LgyeoSWbC2LoxEt6EyCIfwDwfwZAWwAiiabiX99AZx/DXQNBDN0UtAIQvX/hdwDdCiiSXCr+9Q109nJp2Api6KZhaPvYdw0LUmwDgJUvDAG/63ecYsX3bRwiEkMq/vV5xf8CKZ3898XALYAAH7LyhdgewohtAAA+DJz2O0gmlfE/ExGJFRX/+lT8zcmkjdSOQeD3rHwhll+QWAYAK194I15LTN9ymayJYUQkJlT861PxNyubMfbm8RuBt5kazKTYBQArX/hnwC+aGq81pw5YIkmh4l+fir95rWa7J/4nK1/4SpMDmhCrAGDlC+3AR4FWE+OlUymdghVJCBX/+lT8gzHSPUA6ZaxE5oA/sPKFLlMDmhCrAAC8B3jA1GBDXf26B1YkAVT861PxD04uk2O42+gbyPuAXzM5oF+xCQBWvvC9wOtMjZdJZzjT5/sMoYhETMW/PhX/4J3pHSFr5jDgnpdb+cIrTA7oRyoOz4m28gULeAjoNTXmpZELDHb2mRpORCKg4l+fin94FjdWeGz6qskh14DnuY59xeSgJxH5CoCVL2SAdFYDQQAAIABJREFU38dg8R/uGlDxF2lwKv71qfiHq7+jh5FuY09nBujCOw8Q+f505AEAcICvMzVYW66VewbPmhpORCKg4l+fin80Lgyeob2lzeSQXwH8Z5MDnkSkWwBWvvANwF8CRjZZUqkUzz5zPx2tevylSKNS8a9PxT9am7vbfOnGY1SqFVNDVoF/5Tr2X5ga8LgiWwGw8oU+4EEMFX8Aq39MxV+kgan416fiH732ljasgTMmh0zhdQkcMjnocUS5BfDbwDlTg/W2dzPaO2xqOBEJWQjF/4Uq/uLH6Z5B+jt6jA6J1/Y+EpEEACtf+EHgu02Nl8tkuagnX4k0rJCK/3XTA6v4N5/7hs6b7i/zLbX296EL/QyAlS88A/hH4JSpMZ8+epHe9lg1WBKRI1Lxr0/FP75WttZ5ePJxk0PuAF/tOvZDJge9m1BXAKx8oQ34GAaL/1jvsIq/SINS8a9PxT/eek51cqZvxOSQrcBHa+3wQxP2FsA7gGebGqyjtZ3z/WOmhhOREKn416fi3xjO9Y3S1dZhcsgH8Nrhhya0AGDlC98O/Jip8TLpNPeP6JtEpBEFXPyvouIvAUulUlwavkDGbKvg19Xa4ocilABg5QtjwIdMjnnP4DnackYeGigiIQqh+L9AxV/C0Jpr4d4hYzez7flArT1+4AIPALVvmt8DjD1WabCzj6GuflPDiUhIVPzrU/FvXAHUo17g92tt8gMVxgrATwIvMjVYW641iMQlIgFT8a9Pxb/xBbAi/XV4bfIDFehtgFa+8FXAXwNZE+OlUimeNXaJTrMHL0QkYCr+9an4J8fGziZfmriMwZpaBl7kOvanTQ14u8BWAKx8oRv4KIaKP3inLlX8RRqLin99Kv7JEsBdaRngwVrb/EAEuQXw68A9pgbrOdVl+r5LEQmYin99Kv7J5PWl6TY55Dm8f4eBCCQAWPnCq4CXmRovq1a/Ig1Hxb8+Ff9kuzhskcsYW/gG+O5a+3zjjJ8BsPKFS8DngU5TYz5w+l76zD6AQUQCpOJfn4p/c1jeXOWRqSdMDrkF/HPXsR82OajRFQArX8jh7fsbK/6ne4ZU/EUaiIp/fSr+zSOAp9OeAj5Wa6dvjOktgJ8Hnm9qsPaWU6afvywiAVLxr0/Fv/lY/WN0tBp77A14bfTfYXJAYwHAyhf+FfAWU+OlU16r37S+YUQagop/fSr+zSmVSnH/yD2k00bfZ/9Yra2+EUZmZuULw8DvAsb+hV8YPMOpFqOrHSISEBX/+lT8m1tbrpV7Bs+aHvZ3au31ffMdAKx8IQV8GDB2j95ARy8j3YOmhhORAKn416fiLwDDXQMMdBq9lX8Q+L3av19fTKwA/ATwYgPjANCabeHe4fOmhhORAKn416fiL/vdN3SO1myLySFfhNdm3xdftwFa+YIN/B1g5P8sRYpnnrlIV5uxmwhEJCAq/vWp+Es9a9sbfHnycZOtgkvA17uO/fcnHeDEKwBWvtCBd8ufsVhzpm9ExV+kAaj416fiLwfpauvgbN9pk0NmgT+otd0/ET9bAO8Fnubj45+iq62Ts/1GPzkiEgAV//pU/OVuzvadpvuU0Te59+K13T+REwUAK1/4PuA1J73o7bLpDJdGLFLmbiIQkQCo+Nen4i9HdWn4Atl0xuSQL6u13z+2Y58BsPKFC8BDgLH2fPefvoeBjl5Tw4lIAFT861Pxl+Na3FjhsemrJodcB57nOvbjx/mgY60AWPlCFvgDDBb/ke5BFX+RmFPxr0/FX06iv6PH9K3uncBHa+34j+y4WwD/AfiaY37MgU61tHFhUK1+ReJMxb8+FX/x48LgGdrNNrt7Pl47/iM78haAlS/8S+AvMdQ9MJ1K8eyzT6O9xWivZBExSMW/PhV/MWFzd5sv3XiMSrViasgq8M2uY/+vo/zlIxVzK1/oBx486t8/0pgDZ1T8RWJMxb8+FX8xpb2lzfQD71LA79ba89/VUQv6BwFjDY372ns43TNkajgRMUzFvz4VfzHtdM8g/WYfeT8CfLjWpv9Qdw0AVr7ww8B3mpgVQEs2x0W1+hWJLRX/+lT8JSj3DZ2nJXus83t382K8Nv2HOvQMgJUvPBP4LGBsrf4ZYxfpOdVlajgRMUjFvz4VfwnaytY6D08e6y6+u9kFvtp17MJBf+HAFQArX2gDPobB4n+md0TFXySmVPzrU/GXMPSc6uRMn7GH6oLXpv+jtbb9dR22BfArwLNMzaSzrYNz/aOmhhMRg1T861PxlzCd6xulq+3Aen0ST8Nr219X3QBg5QvfAfyIqRlk0hkuDVv6JhKJIRX/+lT8JWypVIpLwxfImG0V/Jpa+/473BEArHzhDN6pf2PuHTpHW67V5JAiYkAIxf+FKv4iR9eaa+HeoXOmh/3NWhv/p3hKAKh9Uz0IDJi66lBXP4OdfaaGExFDQir+10wPrOIvSTfY2cdQV7/JIXuA36+187/p9hWAnwZeYOqKbblW7hk0nmRExKeAi/+TqPiL+HLPoPGV86/Fa+d/083bAK184WuATwPZOz/u+FKpFM8+cz8dre0mhhMRQ0Io/i9Q8Rfxb2Nnky9NXOa4T+09RAV4kevYn4LaCoCVL/TgPeXPSPEHON8/puIvEjMq/vWp+EscdbS2c75/zOSQaeDBWnv/m1sAbwcumLpCb3sXY71HakUsIiFR8a9PxV/ibKx3mN72bpNDngV+CSB1/j9+3gIu4zUN8C2XyfLcc08nlzG2mCAiPqn416fiL42gWC7xheuPUCyXTA1ZAp6exusXbKT4A1wctlT85VDbxR0W1pe5vjjFzOo8a9sbVCrGHocpt1Hxr0/FXxpFLpPl4rBlcsgs8OYs8HxTI46aX6qQBFnb3uDKrMt2ceeOP0uRYqx3mLP9o6T1gmyMin99Kv7SaHrbuxntHWZqedbUkHYWeLqJkTpaT2GZPawgCVGpVrm2OHnoP9wqVSaWZ1jcXOHisEWnDpD6puJfn4q/NCqrf4zVrTU2drZMDHf/XR8HLOJHpVrhsemrR06tW7vbfHnicVa21gKeWbKp+Nen4i9ySxp42MRAGztbuIuTJoaShNgr/subq8f+uEenrioEnJCKf30q/tLo3MVJU+/+AS6ngc+aGm1qefbYL/aSTHtFfHnzZEVcIeBkVPzrU/GXRre8uWpy/x+gkAbeA+yaGvHKrGvyVgVpQKaKt0LA8aj416fiL42uWC6Z/t4uAe9M157U9QFTo3oTHTc1nDQY00VbIeBoVPzrU/GXJLgyO276jfVHXMe+sncI8GeBcVMjL2+uMWl2qUIaQFDFWiHgcCr+9an4SxJMLs+eeCv1ADeAt0GtFbDr2CvAy/CWBYy4tjjJxs6mqeEk5rwi/URgRVohoD4V//pU/CUJNnY2uWb2cH0FeLnr2Iuw73HArmP/X+DnTF2lWq1yeWacsjq8JV6lWuGRqSdY2VoP/DoKAbeo+Nen4i9JUK5UuDwzbvJJgAA/v/ckQNgXAGr+C/BXpq60XdzhyfnrpoaTGKpUvOK/GnDxv3k9hQBAxf8gKv6SFE/OX6/bNdWHv+W2N/lPCQCuY1eAlwMLpq44t7bI/PqSqeEkRiqVCo9Mh1f8b163yUOAin99Kv6SFPPrS8ytLZoccgV4mevY5f2/eUcnQNexJ4DXmrzy1TnjSUYiVg75nf/tmjUEqPjXp+IvSbFd3OHqnPGV89e7jn3HC0fdVsCuY/8J8KumrlyulHl81jW9lyERuVn8t6Mp/nuaLQSo+Nen4i9JUa1WeXzWpVwp3/0vH90HXcf+eL0/OOxZAG8FvmRqBuvbG1xfnDI1nETEK/5XWIu4+O9plhCg4l+fir8kyfXFKda3N0wO+RjwxoP+8MAA4Dr2NvBSwFjj4YnlmcS/UCfZreJv9B+ob37bDsedin99Kv6SJCtba0wsz5gcchd4ievYB75gH/o0QNexvwy82eSMrsy6lNQquOHEtfjvufXgoWSFABX/+lT8JUlK5lv9Avyk69gPHfYX7vo4YNexfwP4b6ZmtFsqcmXW+OuNBKhcKce6+O9JWghQ8a9PxV+S5srsNXZLRZND/jnec34OddcAUPM6vPaBRixtrjC9MmdqOAmQV/yfiH3x35OUEKDiX5+KvyTN9MocS5srRocEXu069l1P3R8pANTaBv47vDaCRrgLE2zuGjteIAEoV8o8HGzxfxAwerMr7A8BjfloahX/+lT8JWk2d7dwFyZMDlkFXuk69pHeYR91BQDXsT8NvP2ks7pdpdYquFJVq+A4KlfKPDx5xfSJ1P3e5Tr2K4BvIrAQ8GTDhQAV//pU/CVpKtVKrQYavT3+l13H/t9H/ctHDgA1/xH4m2N+zIG2drcZnzeafsSA0l7xD+5hTu9yHfvNAK5jF1AIAFT8D6LiL0k0Pj/B1u62ySE/C/zMcT7gWAGg1kbw3wHLx/m4w8yszrOwYWw48alUKfNIsMX/nXvFf49CgIr/QVT8JYkWNpaZWZ03OeQaXqvfY50kPO4KALV2gq8/7scd5ursNXZKuyaHlBMI4Z3/r7iO/ZZ6fxB8CIjvmQAV//pU/CWJdkq7XDV/J9yPuo595bgfdOwAAOA69ifwvvGNKFXKPD7jUkWtgqOyV/w3gi3+bz3sL9RCwDcSSAioxjIEqPjXp+IvSVSlyuMzLiWzrX4fdB37907ygScKADVvBB718fFPsba9zo3FaVPDyTFdnr4aZPH/5bsV/z21xhVNEQLm15dU/OtQ8ZekurE4bbqN+hPAj5z0g08cAFzH3sRrFWzsMX8TSzOx6THfTKZX5lgJ7ql+73Ad+98f5wP2hQBjj6XeE5cQML++xOMz40ENr+IvEjNr2+tMLBlt9VsEXuo69ombnvhZAdh7of5JP2PsF9DyiBxiu7iDuzAZ1PDvcB37bSf5wNq/rW8igSEg4OI/DrxQxV8kPgLa5v5/Xcf+rJ8BfAUAANex3wP8D7/j7AnogIQcYGljJaheDL900uK/J4krASEU/xfUe+63Xyr+IicXwEH3vwB+ye8gvgNAzfcDxp71G8AtEnKAgE78/6Lr2EZWhlzH/gIBh4ClkEKAin99Kv6SZAHc6j6H1+3P93KCkQBQazv4SjC3vhFAkwSpI4CDf7/oOvZPmRww6BBwOYQQML++xJWZwA78jaPiLxI7ATW7+37XsY284Ta1AoDr2H8BvMPUeAG1SZTbmX/hDeQL1sghYK/4B3Sb6zgq/iKxE1C7+/e6jm1sy91YAKj5Wbx2hEYE8KAEuU1na7vpIX/Kyhd+wfSgcDMEvAgwvj8UVAhQ8a9PxV+SLoAH3n0B8HWu6nZGA0CtDeFL8doSGjG9MsfShtFHJco+HeYDAMBPBhgCvoi3EhBICDB5JkDFvz4Vf0m6pQ3jj7zfBF7iOrax2+7B/AoArmP7akxQz5W5a+yWjtXiWI5ooKOXTDoTxNANGQKqhkKAin99Kv6SdLulIlfmjN/J9kbXsY013ttjPAAAuI79IHCi1oT1lMqlIDumNbWWbI4Lg2eCGr4pQ4CKf30q/tIMrsy6lMolk0N+wnVsY6339wskANT8KF6bQiNWttZMd1GSmuGuAfrau4MaPugQEMiZgFsh4HjbTyr+9an4SzOYWJphZcvYDjiA8Yfv7RdYAKi1J3wpXrtCI64vTbG+vWFqONnn0sg9dLV1BjV8kCHgSwQaAp48cghQ8a9PxV+awfr2BteXjLXDASgD/851bKNNBPYLcgWAWpvCnzU1XrVa5fFZl7JaBRuXSad5+uh9CgG3OWoIUPGvT8VfmkG5UubxWZeq2dvW865j/43JAW8XaACoeQfwv00Ntl3c4ercdVPDyT4JCQFGj97CvhBwwN0oKv71qfhLs7g6d53totED+p8G3m5ywHoCDwC1doWvxOAL8/z6EnNrxp8WK4QWAn4xiIFrIeAbCSoEzNwZAlT861Pxl2Yxt7bI/PqSySGXgJe7jh34UncYKwC4jj0NvBqDXeKenDeeuKQmhBDwtoBDQHArAftCgIp/fSr+0iy2izs8OW98Rfq1rmOHssydMrxncSgrX3gX8BOmxutobefZZ+7XC01AypUKj0w9wdr2elCX+CVTDw26nZUvPAv4S2DI9NipVIrT3YNMr8yr+N9GxV+aRbVa5UsTl00/T+U3XMf+YZMDHiaUFYB9fgp4yNRgGzubXFsM7Fn2Ta/BVwL+iQBXAqZW5lT8b6PiL83k2uKk6eL/ZeDNJge8m1ADQK2N4UsAY/fyTS7Psrxp9L5L2UchIFTjqPiLxN7y5hqTy7Mmh9wGXuo6ttGHB9xN2CsAuI79GPBGk2NemR2naLbzkuyTgBDwQsDod2sAxlHxF4m9YrnEldlx08O+tXZ+KVShBwAA17E/CHzc1HhFtQoOXIOHgC/jrQTENQSMo+Iv0hCuzLqm33D+qevYv2pywKOKJADUvB6vzaERy5urTJldkpHbhBQCfimIgWMcAsZR8RdpCFPLsyybfWT4BPAakwMeR2QBwHXsFeBleO0OzYxp/lCG3CaEEPDvmygEjKPiL9IQNnY2cc0eOq8Ar3Ade8HkoMcR5QoArmP/LfAfTY1XrVa5PDNOpVIxNaTUkYAQEIczAeOo+Is0hEqlwuWZcdOtfn/Bdez/Y3LA44o0ANS8HfiUqcG8xgw3TA0nB2jwEPAw0YaAcVT8RRrGk/M3TDee+zvgP5gc8CQiDwCuY1eAlwPGevvOri2Ybs0odSQkBIT9jOlxVPxFGsb8+hKza0ZX6VeAl7mOHfmta5EHAADXsW8ArzU55tW56+yUdk0OKXUkIAS8iPBCwDgq/iINY6e0G8TD537IdewnTQ96ErEIAACuY38S+HVT45UrZSaWpk0NJ4dQCDiScVT8RRrKxNK06cfPf8h17I+ZHNCP2ASAmrfgtUM0Ym5tkd1S0dRwcogEhIAgtwPGUfEXaSi7paLpp85eBn7c5IB+xSoA1NogvgSvLaJvlWrV9N6NHCKkEPCOIAZ2HfsRggkB46j4izSc2bUFKuZO/e/itfo11gbfhFgFALjZuvUtpsbbKeocQJhCCAFvbaAQMI6Kv0hDMlw7ftp17M+bHNCE2AUAANexfw34ExNj6RkB4UtICPB7gGQcFX+RhmWwdvx/wLtMDWZSLANAzWvw2iT6Uq4aPcAhR9TkIWAcFX+RhmaodswAr3IdO5Bnh/sV2wDgOvYiXn8AX3LprIHZyEk0eAh4lJOFgHFU/EUanqHa8SrXsaPuOnqg2AaAmr/3O0BLNmdiHnJCCQgBXwf81RE/5H8CX6/iL9L4DNUO3zUsSHEPAGN+B8gpAESuwUPAVbw+AT+I18GrngW8h3p8i+vYvretbqfiLxI+QwHgjIlBghL3AOD7k9eSUQCIg5BCwC8HMbDr2FXXsT8ADAHPx3uU9S/jda98LnDadewHg7i2ir9INFqyLSaGiXUAiPsGuf8AYOaLKAbshYBHpp5gbXs9iEu8xcoXcB37rUEM7jp2Efh87UfgVPxFomPozWOsA0DcVwB8bwG0agsgVkJYCXhLUCsBYVLxF4mWoS0A3zUsSHEPAL7TU05bALGjEHA4FX+R6GkFIHq+PnmZdIZMOu7/i81JIaA+FX+ReEin02TSGb/DKAD44OuTp1sA400h4KlU/EXixUANUQDwwdf+ie4AiD+FAI+Kv0j8GKghOgPgg78AoBWAhtDsIUDFXySeDNSQEStfiO3ddrENAFa+MAi0+hlDAaBxhBQCfiWowU9KxV8kvgzUkDRw2sBUAhHbAICaADWdEELAm+MUAlT8ReKtJZPsZkBxDgC+9060AtB4miUEqPiLxF/SewHEOQCoC2CTSnoIUPEXaQxJfx5AsgOAtgAaVlJDgIq/SONQAIiO/y6A2dgevpQjSFoIUPEXaSwtmRwpfH8/KQCcgO8eAAa+cBKxpIQAFX+RxmTgjaTOAJyAugAK0PghQMVfpHEZ2ErWCsAJ+Pqk5RQAEiWkEPBO04Oq+Is0NgOHyRUAjsPKF1qAQT9j6ABg8oQQAt5kMgSo+Is0PgOryV1WvtBlYi6mxTIA4O2Z+HpVa9UKQCI1SghQ8RdJhiTfCRDnAOCLegAkV9xDgIq/SHIYWk2O5UHAuAYA/7cAagsg0eIaAlT8RZJFKwDhM9AFUAEg6eIWAlT8RZJHASB8CgByJHEJASr+IsmU5AcCxTUA+NovSafSZNMZU3ORmIs6BKj4iyRXJp0mk/ZdKnUG4BjUBEiOJaQQ8K7bf1PFXyT5DKwCaAXgGBQA5NhCCAE/sT8EqPiLNAcDNUUB4Bh8PwdAmlNYIUDFX6R5GAgAp2uvGbESuwlZ+UIv0O5nDK0ANLcwQgDwJVT8RZqCgTeVWWDYwFSMil0AQHcAiAEhhIBnBDGoir9I/CT1VsBkBgAzt21IgwshBBil4i8STwoA4dEKgBjTKCFAxV8kvgy1llcAOAIFADEq7iFAxV8k3gwdLFcAOAL/DwLSXQBym7iGABV/kfjLZbMmholdM6A4BgBfKSmbyerFVOqKWwhQ8RdpDClSJt5YagXgCHx9klr17l8OEZcQoOIv0liS2AwocQFA+/9yN1GHABV/kcajABAwK1/w3SwhpwAgRxBVCFDxF2lMBgJAr5Uv+GpyZ1qsAgBwGp9z0gFAOaqwQ4CKv0jjMlRbYnUQMG4BwMAtgGoCJEcXVghQ8RdpbEnsBZDAAKAVADmeoEOAir9I40tiN8C4BQD1AJBIBBUCVPxFkkFbAMHTCoBExnQIUPEXSQ6tAATP1ycnlUqRyxjp2CRNylQIUPEXSZZMOkM67btkKgAcwl8PAC3/iwF+Q4CKv0gyJa0bYNwCgK/9ES3/iyl7IaD7mCFAxV8kuQzUGJ0BOIS6AEpsZNJpnjF2kbN9p+9a0NPpNPcMnuX+kXtU/EUSysAKwJiVL8TmBSI2G+ZWvtAFdPkZoyWjHgBiViqV4lz/KP2dvVxbmGBte5NypXzzz7PpDN2nOrEGztCWa41wpiISNAO9AFqAQWDO/2z8i00AQHcASIx1tJzi6aMXAdgq7rBd3KE910ZrTqFTpFkYvBMgFgEgTlsACgDSEE7lWulr71bxF2kySbsVME4BQE2AREQktpLWDChOAUArACIiEltaAQiOAoCIiMSWoRUABYA6fH1SsukM6VSc/ndERCRJDHWbVQCow9e+SE7v/kVEJGAGbgXUGYA61AZYRERizcBWs1YA9rPyhTRw2s8Y2v8XEZGgGXizOWjlC7HoGhaLAACM4LMpkYFlGRERkUMZerMZi22AuAQA9QAQEZHYUwAwz/eeSMb/c5pFREQOlUllTAwTi3MAcXkWgO9PxpVZl8WNFcZ6h+lq6zAxJxEREQDWtzeYXJljcX3ZxHAKAPsY+WQsbiyzuLFMZ2s7Y73D9Hf06tGsIiJyIlWqLG6sMLU8y9r2hsmhFQD2MfrJWN/Z5PLMOK3ZFk73DDHSPUAmbWTZRkREEq5cqTC7tsDUyiw7xd0gLqEAsE8gByJ2Sru4CxPcWJpiuGuQ0d4hWnW3gIiI1LFT2mV6ZY6Z1QXKlXKQl4rFIcC4BIBA74ksVypMrcwyvTJHf2cPoz06JyAiIp71nU2mlmdZ2FimWq2GcclY9AGISwBYCeMiVaosrC+zsL5MV1sHoz3D9Hf2kELnBEREms3ixjKTy3Osba+HfelQat7dxCUAzId9wbXtDda2n6R1oYXRniGGdU5ARCTx9vb3p1fm2C7uRDWN0GtePXEJAJ8EXhPFhXdKu4wvTHB9aZrh7gFGe3ROQEQkaXZLRaZWZpldXaAU7P7+UfxR1BOA+ASA/wlM4/N5AH6UK2WmlmeZXp6jv7OXsZ4hOnVOQESkoUWwv383M8CfRT0JgFRMPiFY+cJLgI9GPY/9uto6GO0dpr9D5wRERBrJ3v37q+Hv79/NS13H/ljUk4AYBQAAK1/4ZeAtUc/jdq25FkZ7hhnuGlDLYRGRmKrcvH8/0v39w/yK69hvjXoSe+KyBbDnbYALvB3oinguN+0Udxmfv8H1xSlGugc4rXMCIiKxsVsq1u7fn4/D/n4968DPAO+PeiL7xWoFYI+VL5wF8sDLiMn9kvulUin6O3oZ6x2ms7U96umIiDSljZ1NJuO1v3+7XeBjgOM6thv1ZG4XywCwx8oXRoAfBX4YGIx4OnV1tXXcfO6AiIgEb2ljhcmVWVa3Yre/v2cR+A3g/a5jT0U9mYPEOgDssfKFNuAVwJuAp0c8nbracq2c7hnSOQERkQBUqhVmVxeZWpmN6/4+wOPAu4EPu469GfVk7qYhAsAeK19IAd8MvBn4poinU1c2nbnZT6BF5wRERHzZLRWZXp1jZiW2+/sAnwLeCfyZ69gNU1QbKgDsZ+ULz8FbEXgZELtKm0qlGOjoZVTnBEREjm1jZ4uplVnm15fiur9fBD4OvNN17M9HPZmTaNgAsMfKF07jnRP4IWJ6TqC7rfNmPwERETnY0qZ3//5KfPf3l4APAO9zHXsi6sn40fABYI+VL5zi1jmBByKeTl1tuVbvuQNdA6R1TkBEBPD29+fWFplcjvX+/hXgPcCHXMfeiHoyJiQmAOypnRN4Md45gW+MeDp1ZdMZRroHOd0zREs2F/V0REQisVveu39/gVK5FPV0DvIZvP39P3UduxL1ZExKXADYr3ZO4M3AS4nxOYGx3mE6dE5ARJrExu4WU8ux3t8vAZ/A29//x6gnE5REB4A9tXMCP4Z3TmAg4unU1X2qk7GeYfp0TkBEEmppc7W2v78W9VQOsgz8Ft7+/vWoJxO0pggAe2rnBF6Jd07gaRFPpy7vnMAww939pFM6JyAijW1vf39qeY6t4nbU0znIVbz9/d9xHTu2pw9Na6oAsKd2TuBb8LYHXhTxdOrKpjOM9AxyulvnBESk8RTLRaZX5plenY/z/v7f4O3vfzJp+/tH0ZQBYD8rX3jWxCMRAAATB0lEQVQuXhB4CTE9JzDY2cdozzAdraeino6IyKE2d7eYjP/+/h/h7e//Q9STiVLTB4A9Vr4wyq1zAv0RT6eu3vYu7hk8R1suds9HEpEmt1Pa5cm56yxtrkY9lYOs4u3vv9d17GtRTyYOFABuY+UL7cCrgJ8A7o94OnfIpNNYA2cY6Y5lzyMRaUKzqwuML0xQjmer3nG8/f0Puo4d29OHUVAAOEDtnMC34m0PvDDi6dzhnsGznO4ZinoaItLkZlcXeGIulm+o/y/e/v5/cx07lskkagoAR2DlC/+MW+cEYnEiL51K85xzD3BK2wEiEpGd0i5fuP5onN75l4E/xtvf/7uoJxN3CgDHYOULY3jnBH6QGJwT6Grr4FlnYrdLISJN4tGpJ+Ky578GfBB4j+vY4xHPpWEoAJxA7ZzAq/HOCVyKci7PPHOJ7rbOKKcgIk1oc3eLL1x/NOppXAPeC/yW69ixSCKNRAHAh9o5gW/D2x54QRRz6O/o4Wmn743i0iLSxK7MusytLUZ1+X/A29//Q+3vn5wCgCFWvmDjBYHvI+RzAvb5Z+jWQBEJTbFc5HPul8O+z78CfBJvf/9vwrxwUikAGGblC2e4dU6gL4xrnu4Z4p7Bs2FcSkSE64tT3FiaDuty68Dv4O3vXw3ros1AASAgVr7QgXdO4I0EfE4gnU7zfOtZZNOZIC8jIkKlWuFz7pfDaO97HXgf8AHXsVeCvlgzUgAImJUvpLl1TuBfBnadgTHGekeCGl5EBICZ1XmuzgX6oLx/xNvf/4Tr2LF9iEASKACEyMoXnocXBP4ths8JtGRzPO/8M0mlUiaHFRF5ioeuPRLEU/0qwJ/i7e9/xvTgUp8CQARq5wR+HHg9Bs8JXBq5wGBnKMcORKQJLW2u8ujUEyaH3AA+BLzbdWyjA8vdKQBEqHZO4Pvxzglc9DteR2s7zzn7NN/zEhGp5+HJK6xsGWmnP8Gt/f0lEwPK8SkAxICVL2SARzEQAp45donuU2oMJCJmGWz8MwHc5zr2jonB5OTSUU9AoNbI4j0mxppamTUxjIjIU0wuG3tteZ+KfzwoAMTHhwDfS2GLGytsF/W9JSLmFMtF5teNrNRvAB8wMZD4pwAQE65jG/vGmFqZMzGMiAgAUyvzprr+fVh7/vGhABAv7wOKfgeZXVugFJ/Hc4pIA6tUK8yszhsZCni3iYHEDAWAGHEdewL4hN9xKhVj37Ai0uTm1hZNdf37M9exr5gYSMxQAIifd5oYZHplLuwHdYhIAk2ZO/xn5LVNzFEAiBnXsT8HfNrvOLulIgsbywZmJCLNamlzlS0zh4o/5zq279c1MUsBIJ6MJGWDt+2ISBPSu/9kUwCIpz8DfO+Vbexssrq1bmA6ItJsNna3THX9uwF83MRAYpYCQAy5jm3stOykGgOJyAkYfPf/Pj3VL54UAOLrwxhoDLSkxkAicky7avzTFBQAYspsYyCtAojI0Rm8i+h3XMfWaeSYUgCINzONgVYX1RhIRI7Ea/yzYGQoDD3jRIKhABBjtcZAvg/PGOzkJSIJZ7Dxz5+6jv2EiYEkGAoA8afGQCISGoO3D+vWv5hTAIg517E/D3zK7zi7JWOHekQkoZY2jR0a/kfXsT9jYiAJjgJAYzCSpHUYUEQOo8Y/zUUBoDH8d+Bxv4Ns7GypMZCI1LWxs8WKmdeH6xh4qJkETwGgAdQaAxk5TavGQCJSj8EVQjX+aRAKAI3jw6gxkIgEwOAZoXXgt0wMJMFTAGgQtcZAv2liLD0kSET2m15V459mpADQWN6PgcZAc2tqDCQinkq1wsyKkT4havzTYBQAGkitMdB/9TuOwW94EWlwBt8Q/Inr2FdNDCThUABoPO8yMYjBJT8RaWBq/NO8FAAajBoDiYgpBg8Ff9Z17L82MZCERwGgMakxkIj4ZvC2YL37b0AKAI3JWGMgQ40/RKTBGGwMdh34QxMDSbgUABpQrTHQu02MZbD1p4g0EIMrgO9V45/GpADQuD6MicZA5h7+ISINQo1/BBQAGpbr2JuoMZCInIDBx4N/0HXsFRMDSfgUABrb+zDVGKisFTyRZlCpVphZVeMfUQBoaK5jT2KqMdDqgoEZiUjcza4aa/zzSdexnzQxkERDAaDxGbn9xuCSoIjEmMHDf7r1r8EpADQ417ELwF/5HWe3rMZAIklnsPHPP7iO/TcmBpLoKAAkg5nGQDoMKJJoavwj+ykAJIOZxkC7W6xsrRmYjojEzcbOpqnGP9eAPzIxkERLASABXMeuosZAInIIg7f7qvFPQigAJMeHgUW/gyxtrrKlxkAiibJbKrKwsWxiqDXgt00MJNFTAEgIk42BtAogkixq/CP1KAAky/tRYyAR2adSMdb4pwy818RAEg8p3fudLFa+8LvAK/yOc75/lDN9pw3MKN4q1Qq7paL3o1z7b2n35s+rQFu2hbZcKwOdfbS3tEU9ZTnEbqnI7NoCO8VdiuUS5WqZXDpLSzZHLpujJZOjJdtCS+3nmXTy3wNNr8zx5PwNE0P9oevY32tiIImHbNQTEOPehYEAMLUyz1jvCKlUysCUwlelSrFU2lfUi+yWd59S7Iul4pE6oq2zAcCNpWmGuvo51z9Ka7Yl6P8FOYad0i4TS9PMrS1SOcabmkw6czMMtGRzt/28hZZMjlwm27DfBwBTK3OmhnqXqYEkHrQCkEBWvvB/gBf4HefisMVQV7//CRlWrpRve8e+9/PdfcW9RJVg/m1n0hnuHTrHYGdfIOPL8cyvL3F17jplM+1t62rJ1FYQagGh9eaKQsvN4JBNZwK7/kktbqzw2PRVE0P9vevYX21iIIkPrQAk0zsxEACmlmdDDQDVavXQor7330qlEtqc6ilXyjw+M87K5hr3DJ4l3QTLyHFUqVR4cv4Gs2vBP8dit+z929s45AaZdCp95yrC/tWEbI5cJkc6xNUEtf2VwygAJNN/By4D9/sZZK8xUM+pLt8TKpVL7NSW3Q/aby822MHD2bUFVrfXuX/kAh2t7VFPp6ls7GxyeWbcVFtbIyrVCtvFnbvOKZvJ0nrbisL+LQcvKPh/aTbY+MdFjX8SSVsACWXlCz8M/Jrfcfrau3lg9L4D/7zuIbr9xb1UpFguHmtfttGkUims/jFGe4ejnkpTmFqexV2cTPTDq1KpVJ1zCS13rC4ctvr0+My4qed7vMV1bK0AJJBWAJLrI8B/Bnyt4S9trjK7tkC1WmWnVHsHv+8wnaHHija0arXK+MIEy1trXBy2jLx7kzsVyyWuzLosb65GPZXAed9vu+yUdg/9ewcdYsxmsmr8I3elFYAEs/KFnwd+Oup5NJNcJsvF4Qv0tvvfNpFbljfXuDI73nDbRAnwLtex3xz1JCQYOr2UbEYaA8nRFcslHpm6grswkegl6rBUq1XchQkembqi4h8+Nf5JOAWABHMdexL4WNTzaEaTy7N8aeJyrA6pNZrt4g5fmrhs8iE2cjx/7Dr2eNSTkOAoACSfDu9EZGNnky/eeJS5Nd/PaGo6c2uLfPHGo2zsbEY9lWamxj8JpzMATcDKF/4SeGHU82hmg5193Dt0jkwMm8XESblS5urcdVOn1+Xk/s517K+JehISLK0ANAetAkRsfn2JL954jPXtjainElvr2xt88cZjKv7xoNeMJqAA0Bz+B15jIInQdnGHf5p8nImlmainEjsTSzP80+TjOjMRD+PAH0c9CQmeAkATcB27Crw76nmId6r92uIkD09eYbekGzR2S0UenrzCtYQ39mkw73UdWw0+moACQPP4CKDTaDGxsrXGF248ytLGStRTiczSxgpfuPEoK1trUU9FbllFjX+ahgJAk3AdexP4jajnIbeUyiUenb7Kk/M3Et0q+XaVapUn52/w6PRVSrq3P25+23VsJbImoZ6lzeX9wFuBZn6Y/Q4wWfsxse/H5G0//yrgQeBM0BOaXpljdct7qNCplragLxeprd1tLs+Ms7m7FdYlp4FXAp8BxvC+nmdu+/n+32sNa2IxpMY/TUa3ATYZK1/4CN4LYtJUgXnqF/Sbv3Yde/6oA1r5wgDwQeA7jM+2jnQqzYXBM4x0D4ZxudDNrM4zPj9BpRra45z/HHi169hzR/2A2tf8oJCw9+shILxn+obn465jf1/Uk5DwKAA0GStfOA98CeiOei7HsMmd79BvL+6TrmMf/uSUE7LyhR8BfgUI5e35QEcv9w6fJ5uQngGlSpmrs9dMPZzmKHaAnwLeUzsAa5SVL+TwwsBBqwh7P2+kZ0RvAs9xHfuJqCci4VEAaEJWvvADwAeingdQAWY5eCl+Au9de2iV4yBWvvBs4KPAM8O4Xmu2hUsjFl1tnWFcLjBr2+s8PuPe9al2Bj0GvMR17IfCuuBBrHyhl4NXEfZ+jBCPs1hvdh1bnf+ajAJAk7LyhZ8DHIJbylzjkKX42o9p17Eb5hTY/9/evYVYVcVxHP+euTjjeBtHPaPjZak4Uj0oW6Mgw6Ag66GHoiDFQAgkgqweyiDYyC6MisDqwcgmqETChxAin+zBF19EdoEQ3l3q6JxRx1HHcca59bBOiMmMzmWvfS6/z+MwZ/8X8zDrf9b+r//fRPFkXIOUt3zEy5Bh/sxGFjTMJVNkJ85DDHGho43WazmG8PY/pgV414ZB0XRbMlFcCcxl5CShiWRP7L4CPrRh4O3djBQGJQBlzETxy7jCwKZRfKwfV1g14uZeypXE+b9bCzDTR7xptVNpbjTUVBVH7WZv/x1O5Cw3e7p8hbwObLZhsNdXQN9MFE/lwQWM8xhdYXcOeM+GgQaGlSklAGUu/w1kHfAKrrhpBncr5Vu5f4PP6ZsCmCheiLslsNZHvKqKSpZmFzFrSr2PcGN29VYnp9vP0T/orY/MIWCDDQPrK2ChMlFcAWQZ/hShDujC9QP5DfjdhoG6UZUxJQAiY5RPnj7GvUrxUrHXOH02i2fPpyJTCK+N7xocGuTslVZyNx76ksW4QwLbgW3qWicyNkoARMbJRPEaYA+wyEe8yZNqWd64mLpJk32Ee6DuO7c5njvL7Ts9vkJeADbaMDjoK6BIKVICIDIB8hXfu4BXfcSryGQws+Yzd8YcH+GG1Xb9MvZqq89OhvuAN20YqK21yDgpARCZQPkrljvwdAd8Zt0MlmUXUVXpt6ln/0A/J9vPca3b2yyDHtxVtZ2+AoqUOiUAIhPMRPGjwK/ACh/xJlVVsyxrmDF5mo9wXL99k5Pt1uc0w6PAehsGR30FFCkHSgBEEmCiuAb4EnjHV8z59Y0sbJhHJpNMz4ChoSHOd1yitTOXyPOHsRP3zd9bgYFIuVACIJIgE8UvAT8CXhr8T62dQnPWUFs9sTNtevp6OdFu6erx1mOnA/euf5+vgCLlRgmASMJMFDcBvwDP+ohXWVHJ0jkLmT11YvoUXem6xunL5xnwd7f/IK7K/4KvgCLlSAmAiAf5Ji1bgQhPY7jnTGtgyeyFVFaMrWfAwOAgZ66c5/JNbwX3A8A2YLuaTYkkTwmAiEcmip/EDRVa4iNebXUNyxsXM6VmdJcSbvV2czx3lp6+3oRWdh+L6+h3yFdAkXKnBEDEMxPF04HvgPU+4mUyGRY1NNFUn32o37/Y2c65jot4/N+wF9fL39udQhFRAiCSGhPFm4BvAS8zf+vrprEsu5jqYXoG9A30c7L9LJ3d3uY43cJN72vxFVBE7lICIJIiE8XNuJ4Bq3zEq66sYlnWUF9373TZzu4bnGy39A14m878F/C6DYNjvgKKyL2UAIikzETxJOAz4H0gmUv8/zOvPotpcFOgbcdFLnW2+wj7nx3ARzYMvBUYiMj9lACIFAgTxS8AP+FGuiZuSo0bJnSr97aPcACXgU02DPb7Cigiw1MCIFJATBQ34pKAdWmvZYIdAN6wYdCW9kJExCmsoeIiZc6GQQ54EfgA8NZsP0F9uP4Hz2vzFyksOgEQKVAmilfjegY0p72WMTqFG+JzOO2FiMj9dAIgUqBsGBzB3Q74Oe21jMFuINDmL1K4dAIgUgRMFG/ATcab/qDfTdlN4G0bBrvTXoiIjEwJgEiRMFG8FPdK4Im01zKMw7gj/1NpL0REHkyvAESKhA2D08DTwOdAIWXuQ8AXwBpt/iLFQycAIkXIRPFzuBHD81JeShvuet+BlNchIqOkEwCRImTD4E9gBfBHisvYD6zQ5i9SnHQCIFLkTBRvwR3B13gK2QtstWHwtad4IpIAJQAiJcBE8UrcUKFHEg51DDfE56+E44hIwvQKQKQE2DD4G1gN/JBgmBZglTZ/kdKgEwCREmOi+DXge6B+gh55Hdhsw2DvBD1PRAqAEgCREmSi2AB7gKfG+ahDwAYbBnb8qxKRQqJXACIlKL9hrwU+AQbH8IhB4FNgrTZ/kdKkEwCREmei+Blcb/4FD/mRC8BGGwYHk1uViKRNJwAiJS6/ka8EdjHyiOE+XBHhSm3+IqVPJwAiZSRfG7AFeBx4LP/jf4AjwDc2DM6ktTYR8etfc7CrpjsDtawAAAAASUVORK5CYII="/>
                            </defs>
                            </svg>
                     </div>
                      <div v-else></div>
                      <span class="mr-2"><i class="fa fa-eye"></i>{{ list.views.length }}</span>
                  </div>
              </div>

     </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  props: ['ld','list'],
  components: {
  },
  data () {
    return {
      drop:false,
      id:4
    }
  },
  methods: {
    deleteList(id){
      let conf=confirm("Are you sure you want to delete this list?")
      if (conf) {
        this.$store.dispatch('deleteList',id).then(()=>{
          this.$snotify.success("Listing deleted")
        })
      }else{
        return
      }
    },
    editShow(id){
      window.eventBus.$emit('showEdit',id);
    },
    showDrop(e){
    let id=e.target.getAttribute('data-id');
    let els=document.getElementById("drop"+id)
      // els.classList.remove('added')

    // if (el.classList.contains('added')) {
    //   el.classList.remove('added')
    // }else{
    //   el.classList.add('added')
    // }
    
    els.classList.toggle('added')

    // setTimeout(function(){
    //    document.querySelectorAll('ul').forEach(el=>{
    //    el.classList.remove('added')
    // })
    // },1000)
    },
   
  },
  created () {
    
  },
  computed: {
    ...mapGetters([
      'user'
    ])
  }
}
</script>

<style lang="scss" scoped>
 .p-card{
   padding:10px;
   margin-bottom:20px;

   .boosted{
    position: absolute;
    left: 10px;
    top: 20px;
    background: #efef15;
    color: #222;
    padding: 5px 10px;
    font-weight: 600;
   }
   & .user-action{
     position:absolute;
     right:0px;
     padding:10px;
     display:flex;
     & div{
       margin:0px 10px;
       & i{
         color:white;
         font-size:30px;
         text-shadow: 2px 2px 6px #333;
       }
     }
     & ul.drop{
       margin:10px;
       padding:10px;
       position:absolute;
       right:10px;
       background:white;
       top:33px;
       display:none;
       opacity:0;
       transition:0.3s;
       z-index: 999;
       &.added{
         display:block;
         opacity:1;
       }
       & li{
         display:block;
         padding:5px 20px;
         margin:3px;
         cursor:pointer;

         &:hover{
           background:#eef4ee
         }

       }
     }
   }
   & .img {
     height: 200px;
   img{
     object-fit:cover;
     border-radius:5px;
     width:100%;
     height:100%;

   }

   .location{
         position: absolute;
        transform: translateY(-40px);
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        padding: 10px;
        width: 94%;
        background-image: linear-gradient(45deg, black, transparent);
   }
   }
   & .details{
     border:1px solid #f6f6f6;
     border-radius: 3px;
     margin-top:10px;
     padding:5px;
     & .title{
       position:relative;
       & button{
         right:5px;
         top:0px;
         position:absolute
       }
       & h4{
          font-size: 22px !important;
       }
     }   
     & .l-p{
         display: flex;
         justify-content: space-between;
         align-items:center;
        //  padding: 5px 10px;

         & h4{
           color:#222;
           font-size:16px;
          //  font-weight: bolder;
         }
     }


     & .l-p{
       padding-top:10px;
       & h4{
           color:rgba($color: #000000, $alpha: 0.8);
           font-size:18px;
          // margin-left:-5px
         }
        & h5{
          font-size: 14px;
        }
      }

    & .description{
        & h4{
          color:#444;
          font-size: 18px;
          // font-weight: bolder;
        }
    }

    & .c-t-a{
      display: flex;
      justify-content: space-between;

      & span{
      color: #031a2d;
      font-size: 12px;
      font-weight: 800;
        & i{
        font-size:20px;
        margin:0px 5px;
        
        }
      }
    }
     
   }
 }
</style>

<style lang="scss">
.anim{
  padding:10px 20px;
  background:#fff;
  width:130px;
  font-size: 20px;
  position:relative;
  overflow: hidden;
  margin:50px;
  color: #5895f9;
  box-sizing: border-box;

  &::after{
    content: "";
    height:100%;
    width:50%;
    background:rgba($color: #ffffff, $alpha:0.8);
    position:absolute;
    top:0px;
    left: 0px;
    animation:load 0.5s infinite alternate
    
  }

  @keyframes load {
    from{
      transform: translateX(0%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
      border-left: 2px solid #5895f9; 
    }
    to{
      transform: translateX(100%);
      background-color: rgba($color: #5895f9, $alpha:0.8);
    }
  }


}
</style>