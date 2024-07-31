pipeline {
    agent any
    stages {
        stage('Clone git repo') {
            steps {
                echo 'Clone git repo'
                sh 'rm -fr Sige'
                sh 'git clone -b test https://github.com/D-nss/Sige.git'
            }
        }
        stage('Copy .env') {
            steps {
                echo 'Copy .env'
                sh '''
                    cd Sige
                    cp .env.example .env
                '''
            }
        }
        stage('Composer install') {
            steps {
                echo 'Composer install'
                sh '''
                    cd Sige
                    composer install
                '''
            }
        }
        stage('Migrate') {
            steps {
                echo 'Migarte'
                catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE'){
                sh '''
                    cd Sige
                    php artisan migrate:fresh
                '''
                }
            }
        }
        stage('Seed') {
            steps {
                echo 'Seed'
                catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE'){
                sh '''
                    cd Sige
                    php artisan db:seed
                '''
                }
            }
        }
        stage('Run tests') {
            steps {
                echo 'Run tests'
                sh '''
                cd Sige
                php artisan config:cache
                php artisan config:clear
                vendor/bin/phpunit --verbose tests/
                '''
            }
        }
        stage('Deploy in main branch') {
            steps {
                echo 'Deploy in main branch'
                sh '''
                cd Sige
                git add .
                git commit -m "deploy"
                git remote set-url origin https://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@github.com/D-nss/Sige.git
                git push origin test
                '''
            }
        }
    }
}
