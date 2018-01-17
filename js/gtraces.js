"use strict";

var INTERVALS = [];
// const INTERVALS = [[20, 0], [30, 15], [60, 25]];
var DAY = 24 * 60 * 60 * 1000;
var PT_OFFSET = 8 * 60 * 60 * 1000;
var RACES = [];
var updateInterval = void 0;
start();

function start() {
    /* globals INTERVALS, RACES, updateInterval, calc, bind, update */
    window.addEventListener("load", function () {
        INTERVALS.forEach(function (e, i) {
            RACES.push(calc(e[0] * 60000, e[1] * 60000));
        });
        bind();
        if (updateInterval) window.clearInterval(updateInterval);
        updateInterval = window.setInterval(update, 3000);
    });
}
/**
 * @param {number} interval The interval between races in milliseconds.
 * @param {number} delay The delay of the first race of the day in milliseconds.
 */
function calc(interval, delay) {
    /* globals DAY, PT_OFFSET */
    var result = { pt: [], local: [], status: null, index: null, len: null };
    var NOW = new Date();
    var LOCAL_OFFSET = NOW.getTimezoneOffset() * 60 * 1000;
    var PT_NOW = new Date(NOW.getTime() + LOCAL_OFFSET - PT_OFFSET);
    var PT_INITIAL = new Date(PT_NOW.getFullYear(), PT_NOW.getMonth(), PT_NOW.getDate());
    PT_INITIAL = PT_INITIAL.getTime();
    var t = delay;
    while (t < DAY) {
        result.pt.push(new Date(PT_INITIAL + t));
        var I = result.local.push(new Date(PT_INITIAL + t + PT_OFFSET - LOCAL_OFFSET));
        var index = I - 1;
        var RACE_LOCAL_TIME = result.local[index];
        if (!result.status && RACE_LOCAL_TIME > NOW) {
            result.index = index;
            result.status = calcStatus(RACE_LOCAL_TIME, NOW);
        }
        t += interval;
    }
    result.len = result.local.length;
    return result;
}
/**
 * @param {Date} raceStartTime
 * @param {Date} now
 */
function twoDigits(value) {
    if (value < 10) return "0" + value;else return value;
}

function calcStatus(raceStartTime, now) {
    var next = raceStartTime;
    var h = twoDigits(raceStartTime.getHours());
    var m = twoDigits(raceStartTime.getMinutes());
    var nextRace = h + ":" + m;
    var entryEndsIn = raceStartTime - now;
    var entryStartsIn = entryEndsIn - 15 * 60 * 1000;
    var entryIsOpen = entryStartsIn <= 0;
    entryEndsIn = Math.floor(entryEndsIn / 60000) + 1;
    entryStartsIn = Math.floor(entryStartsIn / 60000) + 1;
    return { next: next, nextRace: nextRace, entryEndsIn: entryEndsIn, entryStartsIn: entryStartsIn, entryIsOpen: entryIsOpen };
}

function update() {
    /* globals RACES, bind */
    var NOW = Date.now();
    RACES.some(function (race, i) {
        var index = race.index,
            status = race.status;

        if (NOW > status.next) {
            index++;
            if (index >= race.len) {
                start();
                return true;
            }
            status.next = race.local[index];
            race.index = index;
        }
        race.status = calcStatus(status.next, NOW);
    });
    bind();
}

function minsLeft(x) {
    return x = x + " min";
}

function bind() {
    /* globals $, RACES */
    $(".daily").each(function (index, value) {
        var race = RACES[index];
        if (!race) return;
        var status = race.status;

        if (!status) return;
        var _race$status = race.status,
            entryIsOpen = _race$status.entryIsOpen,
            entryStartsIn = _race$status.entryStartsIn,
            entryEndsIn = _race$status.entryEndsIn,
            nextRace = _race$status.nextRace;

        var $this = $(this);
        var $raceEntry = $this.find(".race-entry");
        var $startTime = $this.find(".start-time .col-8 span span");
        var $noEntry = $this.find(".start-time .col-8 span");
        if (!entryIsOpen) {
            $raceEntry.hide();
            $noEntry.hide();
            /*$startTime.text(minsLeft(entryStartsIn));*/
        } else {
            $raceEntry.show();
            $noEntry.show();
            $startTime.text(minsLeft(entryEndsIn));
        }
        $this.find(".start-time h5").text(nextRace);
    });
}
