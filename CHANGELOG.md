# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Nothing yet

### Changed
- Nothing yet

### Deprecated
- Nothing yet

### Removed
- Nothing yet

### Fixed
- Nothing yet

### Security
- Nothing yet

## [1.2.0] - 2025-01-XX

### Added
- ✨ Comprehensive CI/CD pipeline with GitHub Actions
- ✨ Multi-PHP version testing (8.2, 8.3, 8.4)
- ✨ Code quality checks with Laravel Pint
- ✨ Security audits with Composer audit
- ✨ Code coverage reporting with Xdebug
- ✨ Private repository authentication support
- ✨ Custom Packagist repository support
- 📊 Detailed coverage analysis and reports
- 📚 Comprehensive documentation
- 🔧 Updated all GitHub Actions to latest versions
- 🚀 Automatic release to Packagist on tag push

### Changed
- 🔄 Updated license from proprietary to MIT
- 🔄 Enhanced README with badges and documentation
- 🔄 Improved test coverage reporting

### Fixed
- 🐛 Fixed deprecated GitHub Actions versions
- 🐛 Resolved private repository authentication issues
- 🐛 Improved error handling in CI/CD pipeline

## [1.1.0] - 2024-XX-XX

### Added
- ✨ Content management features
- ✨ Markdown support
- ✨ Word count and read time calculations

## [1.0.0] - 2024-XX-XX

### Added
- 🎉 Initial release
- ✨ Basic post management
- ✨ Slug generation
- ✨ Soft deletes

---

## Release Process

### Creating a New Release

1. **Update CHANGELOG.md** with new version and changes
2. **Commit changes** to master branch
3. **Create and push tag**:
   ```bash
   git tag v1.2.1
   git push origin v1.2.1
   ```
4. **GitHub Actions** will automatically:
   - Run tests and quality checks
   - Create GitHub release
   - Publish to Packagist

### Version Format

- **Major.Minor.Patch** (e.g., v1.2.1)
- **Pre-release**: v1.2.1-alpha.1
- **Release candidate**: v1.2.1-rc.1

### Required Secrets

For automatic releases to work, set these GitHub secrets:

- `PACKAGIST_USERNAME`: Your Packagist username
- `PACKAGIST_TOKEN`: Your Packagist API token
- `PAT_TOKEN`: (Optional) Personal Access Token for private repos 