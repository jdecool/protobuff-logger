pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'docker run --rm -v $(pwd):/app jdecool/protoc --proto_path=proto/ --php_out=build/ proto/*.proto'
                sh 'docker run --rm -v $(pwd):/app composer:1.5 install'
            }
        }

        stage('Check proto') {
            steps {
                sh 'scripts/check-build-classes.sh'
            }
        }

        stage('Tests') {
            parallel {
                stage('PHP 5.6') {
                    steps {
                        sh 'docker run --rm -v $(pwd):/usr/src/myapp -w /usr/src/myapp php:5.6-cli-alpine php vendor/bin/atoum'
                    }
                }

                stage('PHP 7.0') {
                    steps {
                        sh 'docker run --rm -v $(pwd):/usr/src/myapp -w /usr/src/myapp php:7.0-cli-alpine php vendor/bin/atoum'
                    }
                }

                stage('PHP 7.1') {
                    steps {
                        sh 'docker run --rm -v $(pwd):/usr/src/myapp -w /usr/src/myapp php:7.1-cli-alpine php vendor/bin/atoum'
                    }
                }

                stage('PHP 7.2') {
                    steps {
                        sh 'docker run --rm -v $(pwd):/usr/src/myapp -w /usr/src/myapp php:7.2-cli-alpine php vendor/bin/atoum'
                    }
                }
            }
        }
    }
}
