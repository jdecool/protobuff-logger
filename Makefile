.PHONY: help

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

protoc: ## Parse proto files and generate output based
	@mkdir -p build
	@protoc --proto_path=proto/ --php_out=build/ proto/*.proto
	@composer dump-autoload > /dev/null 2>&1
