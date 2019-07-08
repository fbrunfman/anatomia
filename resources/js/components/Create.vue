<template>
    <div class="contenedor-create ">
        <div class="create"> <h1>Crear curso</h1></div>
        <form action="">
            <div class="crear-curso">
                <b-form-group
                    id="fieldset-1"
                    label="Nombre del curso"
                    label-for="input-1"
                >
                    <div class="d-flex flex-row align-items-center">
                    <b-form-input id="input-1" v-model="course[0].name" trim></b-form-input>
                    <i class="fas fa-plus" @click="createLesson"></i>
                    </div>
                </b-form-group>
                <div class="crear-leccion ml-4" v-for="(lesson, k) in course[0].lessons" :key="'lesson-' + k">
                    <b-form-group
                        :id="'lesson-' + k"
                        label="Nombre de la lección"
                        :label-for="'lesson-' + k"
                    >
                        <div class="d-flex flex-row align-items-center">
                        <b-form-input :id="'lesson-' + k" v-model="course[0].lessons[k].name" trim></b-form-input>
                        <i class="fas fa-plus" @click="createChapter(k)"></i>
                        <i class="fas fa-minus"></i>
                        </div>
                    </b-form-group>
                    <div class="crear-capitulo" v-for="(chapter, j) in course[0].lessons[k].chapters" :key="'chapter-' + j">
                        <b-form-group
                            :id="'chapter-' + j"
                            label="Nombre del  capítulo"
                            :label-for="'chapter-' + j"
                        >
                            <div class="d-flex flex-row align-items-center">
                                <b-form-input :id="'chapter-' + j" v-model="course[0].lessons[k].chapters[j].name" trim></b-form-input>
                                <i class="fas fa-plus" @click="createScreenQuestion(j, k)"></i>
                                <i class="fas fa-minus"></i>
                            </div>
                        </b-form-group>
                        <div class="crear-pantalla ml-4 my-2" v-for="(screen, l) in course[0].lessons[k].chapters[j].screens" :key="'screen-' + l">
                            <b-form-group
                                :id="'screen-text-' + l"
                                label="Nombre de la pantalla"
                                :label-for="'screen-text-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'screen-text-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].text" trim></b-form-textarea>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'screen-order-' + l"
                                label="Orden de la pantalla"
                                :label-for="'screen-order-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                <b-form-input :id="'screen-order-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].order" type="number" trim></b-form-input>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'screen-url-' + l"
                                label="Url de la imagen de la pantalla"
                                :label-for="'screen-url-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-input :id="'screen-url-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].image_url" trim></b-form-input>
                                </div>
                            </b-form-group>
                        </div>
                        <div class="crear-pregunta ml-4 my-2" v-for="(question, l) in course[0].lessons[k].chapters[j].questions" :key="'question-' + l">
                            <div class="text-right">
                                <i class="fas fa-plus" @click="createAnswer(l, j, k)"></i>
                                <i class="fas fa-minus"></i>
                            </div>
                            <b-form-group
                                :id="'question-text-' + l"
                                label="Nombre de la pregunta"
                                :label-for="'question-text-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'question-text-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].name" trim></b-form-textarea>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'question-order-' + l"
                                label="Orden de la pregunta"
                                :label-for="'question-order-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-input :id="'question-order-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].order" type="number" trim></b-form-input>
                                </div>
                            </b-form-group>
                            <div class="crear-respuesta ml-4 my-2" v-for="(answer, p) in course[0].lessons[k].chapters[j].questions[l].answers" :key="'answer-' + p">
                                <b-form-group
                                    :id="'answer-text-' + p"
                                    label="Nombre de la respuesta"
                                    :label-for="'answer-text-' + p"
                                >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'answer-text-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].answers[p].name" trim></b-form-textarea>
                                </div>
                                </b-form-group>
                                <span>Respuesta falsa o verdadera</span>
                                <b-form-select v-model="course[0].lessons[k].chapters[j].questions[l].answers[p].is_correct">
                                    <option value="0">Falsa</option>
                                    <option value="1">Verdadera</option>
                                </b-form-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    computed: {
        state() {
        return this.courseName.length >= 1 ? true : false
        }
    },
    data() {
        return {
            courseName: '',
            lecciones: {
                leccion: []
            },
            capitulos: {
                capitulo: []
            },
            lessons: 0,
            chapters: 0,
            course:[{
                name: '',
                lessons: [
                    {
                        name:'',
                        chapters: [
                            {
                                name:'',
                                screens: [
                                    {
                                        text: '',
                                        order: '',
                                        image_url: ''
                                    }
                                ],
                                questions: [
                                    {
                                        name: '',
                                        order: '',
                                        answers: [
                                            {
                                                name: '',
                                                is_correct: 'Respuesta falsa o verdadera'
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }]
        }
    },
    methods: {
        createLesson() {
            this.course[0].lessons.push({
                name:'',
                chapters: [
                {
                    name:'',
                    screens: [
                        {
                            text: '',
                            order: '',
                            image_url: ''
                        }
                    ],
                    questions: [
                        {
                            name: '',
                            order: '',
                            answers: [
                                {
                                    name: '',
                                    is_correct: ''
                                }
                            ]
                        }
                    ]
                }
                ]
            })
        },
        createChapter(k) {
            this.course[0].lessons[k].chapters.push({
                name:'',
                screens: [
                    {
                        text: '',
                        order: '',
                        image_url: ''
                    }
                ],
                questions: [
                    {
                        name: '',
                        order: '',
                        answers: [
                            {
                                name: '',
                                is_correct: ''
                            }
                        ]
                    }
                ]
            })
        },
        createScreenQuestion(j, k) {
            this.course[0].lessons[k].chapters[j].screens.push({
                text: '',
                order: '',
                image_url: ''
            })
            this.course[0].lessons[k].chapters[j].questions.push({
                name: '',
                order: '',
                answers: [
                    {
                        name: '',
                        is_correct: ''
                    }
                ]
            })
        },
        createAnswer(l, j, k) {
            this.course[0].lessons[k].chapters[j].questions[l].answers.push({
                name: '',
                is_correct: ''
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.contenedor-create {
    max-width: 65;
    width: 55vw;
    display: flex;
    flex-direction: column;
}

i.fas.fa-plus, .fa-minus {
    font-size: 1.5rem;
    margin-left: 1.2rem;
    cursor: pointer;
}

.crear-capitulo {
    margin-left: 4rem;
}

.crear-pantalla,
.crear-pregunta  {
    border: 3px solid grey;
    padding: 15px;
    border-radius: 10px;
}

</style>
