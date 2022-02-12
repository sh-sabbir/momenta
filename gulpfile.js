const { src, watch, dest, series } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const csso = require("gulp-csso");
const rename = require("gulp-rename");
const babel = require("gulp-babel");
const csscomb = require("gulp-csscomb");
const autoPrefixer = require("gulp-autoprefixer");
const plumberNotifier = require("gulp-plumber-notifier");
const concat = require("gulp-concat");
const clean = require("gulp-clean");
const wpPot = require("gulp-wp-pot");
const terser = require("gulp-terser");

const AUTOPREFIXER_BROWSERS = [
	"last 2 version",
	"> 1%",
	"ie >= 9",
	"ie_mob >= 10",
	"ff >= 30",
	"chrome >= 34",
	"safari >= 7",
	"opera >= 23",
	"ios >= 7",
	"android >= 4",
	"bb >= 10",
];

const sassFiles = "assets/dev/sass/*.scss";
const jsFiles = "assets/dev/js/*.js";
const terserConfig = {
	toplevel: true,
	ie8: true,
	safari10: true,
};

function makeCSS() {
	return src(sassFiles)
		.pipe(plumberNotifier())
		.pipe(sass())
		.pipe(autoPrefixer(AUTOPREFIXER_BROWSERS))
		.pipe(csscomb())
		.pipe(concat("main.css"))
		.pipe(dest("assets/css"))
		.pipe(csso())
		.pipe(rename({ suffix: ".min" }))
		.pipe(dest("assets/css"));
}

function makeJS() {
	return src(jsFiles)
		.pipe(plumberNotifier())
		.pipe(
			babel({
				presets: ["@babel/env"],
			})
		)
		.pipe(dest("assets/js"))
		.pipe(rename({ suffix: ".min" }))
		.pipe(terser(terserConfig))
		.pipe(dest("assets/js"))
		.on("error", swallowError);
}

function swallowError(error) {
	// If you want details of the error in the console
	console.log(error.toString());
	this.emit("end");
}

function startWatching() {
	watch(sassFiles, makeCSS);
	watch(jsFiles, makeJS);
}

function deleteOld() {
	return src(["assets/css", "assets/js"], {
		read: false,
	}).pipe(clean({ force: true }));
}

function translate() {
	return src(["./*.php", "./**/*.php"])
		.pipe(
			wpPot({
				domain: "momenta",
				package: "Momenta",
				team: "Codeian <codeian.lab@gmail.com>",
			})
		)
		.pipe(dest("i18n/momenta.pot"));
}

exports.translate = translate;
exports.clean = deleteOld;
exports.default = series(makeCSS, makeJS, startWatching);
