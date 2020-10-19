include .env
NAME := $(or $(BASE_IMAGE),$(BASE_IMAGE),drupalwxt/site-wxt)
VERSION := $(or $(VERSION),$(VERSION),'latest')
PLATFORM := $(shell uname -s)
$(eval GIT_USERNAME := $(if $(GIT_USERNAME),$(GIT_USERNAME),gitlab-ci-token))
$(eval GIT_PASSWORD := $(if $(GIT_PASSWORD),$(GIT_PASSWORD),$(CI_JOB_TOKEN)))
DOCKER_REPO := https://github.com/drupalwxt/docker-scaffold.git
GET_DOCKER := $(shell [ -d docker ] || git clone $(DOCKER_REPO) docker)
include docker/Makefile
