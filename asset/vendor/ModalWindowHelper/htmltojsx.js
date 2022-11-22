'Converter version [AHP]';
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["htmltojsx"] = factory();
	else
		root["htmltojsx"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/** @preserve
 *  Copyright (c) 2014, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */


/**
 * This is a very simple HTML to JSX converter. It turns out that browsers
 * have good HTML parsers (who would have thought?) so we utilise this by
 * inserting the HTML into a temporary DOM node, and then do a breadth-first
 * traversal of the resulting DOM tree.
 */

// https://developer.mozilla.org/en-US/docs/Web/API/Node.nodeType

var NODE_TYPE = {
    ELEMENT: 1,
    TEXT: 3,
    COMMENT: 8
};

var ATTRIBUTE_MAPPING = {
    'for': 'htmlFor',
    'class': 'className'
};

var ELEMENT_ATTRIBUTE_MAPPING = {
    'input': {
        'checked': 'defaultChecked',
        'value': 'defaultValue'
    }
};

var SVG_ATTRIBUTE_MAPPING = {};

var SVG_TAG_MAPPING = ['circle', 'defs', 'ellipse', 'g', 'line', 'linearGradient', 'mask', 'path', 'pattern', 'polygon', 'polyline', 'radialGradient', 'rect', 'stop', 'svg', 'text', 'tspan'];
/**
 * é‡åˆ° key ä¸ºè¿™äº›æ ‡ç­¾çš„æœ€å¤–å±‚éœ€è¦ç”¨ value å¯¹åº”çš„æ ‡ç­¾åŒ…è£¹, ä½†ä»¥ä¸‹çš„æ ‡ç­¾é™¤å¤–, ä¸èƒ½æž
 * noframes, frame, frameset, html, head, body, script
 * @type {{thead: string, tbody: string, tfoot: string, caption: string, colgroup: string, col: string, tr: string, th: string, td: string, dt: string, dd: string}}
 */
var CONTAINER_MAPPING = {
    'thead': 'table',
    'tbody': 'table',
    'tfoot': 'table',
    'caption': 'table',
    'colgroup': 'table',
    'col': 'colgroup',
    'tr': 'tbody',
    'th': 'tr',
    'td': 'tr',
    'dt': 'dl',
    'dd': 'dl'
};

var HTMLDOMPropertyConfig = __webpack_require__(4);
var SVGDOMPropertyConfig = __webpack_require__(5);

// Populate property map with ReactJS's attribute and property mappings
// TODO handle/use .Properties value eg: MUST_USE_PROPERTY is not HTML attr
for (var propname in HTMLDOMPropertyConfig.Properties) {
    if (!HTMLDOMPropertyConfig.Properties.hasOwnProperty(propname)) {
        continue;
    }

    var mapFrom = HTMLDOMPropertyConfig.DOMAttributeNames[propname] || propname.toLowerCase();

    if (!ATTRIBUTE_MAPPING[mapFrom]) ATTRIBUTE_MAPPING[mapFrom] = propname;
}

for (var propname in SVGDOMPropertyConfig.Properties) {
    if (!SVGDOMPropertyConfig.Properties.hasOwnProperty(propname)) {
        continue;
    }

    var mapFrom = SVGDOMPropertyConfig.DOMAttributeNames[propname] || propname.toLowerCase();

    if (!ATTRIBUTE_MAPPING[mapFrom]) SVG_ATTRIBUTE_MAPPING[mapFrom] = propname;
}

/**
 * Repeats a string a certain number of times.
 * Also: the future is bright and consists of native string repetition:
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/repeat
 *
 * @param {string} string  String to repeat
 * @param {number} times   Number of times to repeat string. Integer.
 * @see http://jsperf.com/string-repeater/2
 */
function repeatString(string, times) {
    if (times === 1) {
        return string;
    }
    if (times < 0) {
        throw new Error();
    }
    var repeated = '';
    while (times) {
        if (times & 1) {
            repeated += string;
        }
        if (times >>= 1) {
            string += string;
        }
    }
    return repeated;
}

/**
 * Determine if the string ends with the specified substring.
 *
 * @param {string} haystack String to search in
 * @param {string} needle   String to search for
 * @return {boolean}
 */
function endsWith(haystack, needle) {
    return haystack.slice(-needle.length) === needle;
}

/**
 * Trim the specified substring off the string. If the string does not end
 * with the specified substring, this is a no-op.
 *
 * @param {string} haystack String to search in
 * @param {string} needle   String to search for
 * @return {string}
 */
function trimEnd(haystack, needle) {
    return endsWith(haystack, needle) ? haystack.slice(0, -needle.length) : haystack;
}

/**
 * Convert a hyphenated string to camelCase.
 */
function hyphenToCamelCase(string) {
    return string.replace(/-(.)/g, function (match, chr) {
        return chr.toUpperCase();
    });
}

/**
 * Determines if the specified string consists entirely of whitespace.
 */
function isEmpty(string) {
    return !/[^\s]/.test(string);
}

/**
 * Determines if the CSS value can be converted from a
 * 'px' suffixed string to a numeric value
 *
 * @param {string} value CSS property value
 * @return {boolean}
 */
function isConvertiblePixelValue(value) {
    return (/^\d+px$/.test(value)
    );
}

/**
 * Determines if the specified string consists entirely of numeric characters.
 */
function isNumeric(input) {
    return input !== undefined && input !== null && (typeof input === 'number' || parseInt(input, 10) == input);
}
/**
 * Handles parsing of inline styles
 *
 * @param {string} rawStyle Raw style attribute
 * @constructor
 */
var StyleParser = function StyleParser(rawStyle) {
    this.parse(rawStyle);
};
StyleParser.prototype = {
    /**
     * Parse the specified inline style attribute value
     * @param {string} rawStyle Raw style attribute
     */
    parse: function parse(rawStyle) {
        this.styles = {};
        rawStyle.split(';').forEach(function (style) {
            style = style.trim();
            var firstColon = style.indexOf(':');
            var key = style.substr(0, firstColon);
            var value = style.substr(firstColon + 1).trim();
            if (key !== '') {
                // Style key should be case insensitive
                key = key.toLowerCase();
                this.styles[key] = value;
            }
        }, this);
    },

    /**
     * Convert the style information represented by this parser into a JSX
     * string
     *
     * @return {string}
     */
    toJSXString: function toJSXString() {
        var output = [];
        for (var key in this.styles) {
            if (!this.styles.hasOwnProperty(key)) {
                continue;
            }
            output.push(this.toJSXKey(key) + ': ' + this.toJSXValue(this.styles[key]));
        }
        return output.join(', ');
    },

    /**
     * Convert the CSS style key to a JSX style key
     *
     * @param {string} key CSS style key
     * @return {string} JSX style key
     */
    toJSXKey: function toJSXKey(key) {
        // Don't capitalize -ms- prefix
        if (/^-ms-/.test(key)) {
            key = key.substr(1);
        }
        return hyphenToCamelCase(key);
    },

    /**
     * Convert the CSS style value to a JSX style value
     *
     * @param {string} value CSS style value
     * @return {string} JSX style value
     */
    toJSXValue: function toJSXValue(value) {
        if (isNumeric(value)) {
            // If numeric, no quotes
            return value;
        } else if (isConvertiblePixelValue(value)) {
            // "500px" -> 500
            return trimEnd(value, 'px');
        } else {
            // Probably a string, wrap it in quotes
            return '\'' + value.replace(/'/g, '"') + '\'';
        }
    }
};

module.exports = function (createElement) {
    var tempEl = createElement('div');
    tempEl.id = 'SFRootPage';
    /**
     * Escapes special characters by converting them to their escaped equivalent
     * (eg. "<" to "&lt;"). Only escapes characters that absolutely must be escaped.
     *
     * @param {string} value
     * @return {string}
     */
    function escapeSpecialChars(value) {
        // Uses this One Weird Trick to escape text - Raw text inserted as textContent
        // will have its escaped version in innerHTML.
        tempEl.textContent = value;
        return tempEl.innerHTML;
    }

    var htmltojsx = function htmltojsx(config) {
        this.config = config || {};

        if (this.config.createClass === undefined) {
            this.config.createClass = true;
        }
        if (this.config.outputClassName && this.config.outputClassName + '') {
            this.config.outputClassName = this.config.outputClassName.replace(/^\w/, function (s) {
                return s.toUpperCase();
            });
        }
        if (!this.config.indent) {
            this.config.indent = '  ';
        }
    };

    htmltojsx.prototype = {
        /**
         * Reset the internal state of the converter
         */
        reset: function reset() {
            this.output = '';
            this.level = 0;
            this._inPreTag = false;
        },
        /**
         * Main entry point to the converter. Given the specified HTML, returns a
         * JSX object representing it.
         * @param {string} html HTML to convert
         * @return {string} JSX
         */
        convert: function convert(html) {
            this.reset();

            var containerEl = createElement(this._chooseContainer(html));
            containerEl.id = 'SFRootPage';
            containerEl.innerHTML = '\n' + this._cleanInput(html) + '\n';

            if (this.config.createClass) {
                if (this.config.outputClassName) {
                    this.output = 'var ' + this.config.outputClassName + ' = React.createClass({\n';
                } else {
                    this.output = 'React.createClass({\n';
                }
                this.output += this.config.indent + 'render: function() {' + "\n";
                this.output += this.config.indent + this.config.indent + 'return (\n';
            }

            if (this._onlyOneTopLevel(containerEl)) {
                // Only one top-level element, the component can return it directly
                // No need to actually visit the container element
                this._traverse(containerEl);
            } else {
                // More than one top-level element, need to wrap the whole thing in a
                // container.
                this.output += this.config.indent + this.config.indent + this.config.indent;
                this.level++;
                this._visit(containerEl);
            }
            this.output = this.output.trim() + '\n';
            if (this.config.createClass) {
                this.output += this.config.indent + this.config.indent + ');\n';
                this.output += this.config.indent + '}\n';
                this.output += '});';
            }
            return this.output;
        },
        /**
         * Choose the correct container of input html.
         * Edited by RequireSun 2016-11-19 17:36
         * @param {string} html HTML you want to format
         * @returns {string}
         * @private
         */
        _chooseContainer: function _chooseContainer(html) {
            var regex = /<([^\s>]+)/;
            regex = (html || '').match(regex);

            return regex && CONTAINER_MAPPING[regex[1]] ? CONTAINER_MAPPING[regex[1]] : 'div';
        },
        /**
         * Cleans up the specified HTML so it's in a format acceptable for
         * converting.
         *
         * @param {string} html HTML to clean
         * @return {string} Cleaned HTML
         */
        _cleanInput: function _cleanInput(html) {
            // Remove unnecessary whitespace
            html = html.trim();
            // Ugly method to strip script tags. They can wreak havoc on the DOM nodes
            // so let's not even put them in the DOM.
            html = html.replace(/<script([\s\S]*?)<\/script>/g, '');
            return html;
        },

        /**
         * Determines if there's only one top-level node in the DOM tree. That is,
         * all the HTML is wrapped by a single HTML tag.
         *
         * @param {DOMElement} containerEl Container element
         * @return {boolean}
         */
        _onlyOneTopLevel: function _onlyOneTopLevel(containerEl) {
            // Only a single child element
            if (containerEl.childNodes.length === 1 && containerEl.childNodes[0].nodeType === NODE_TYPE.ELEMENT) {
                return true;
            }
            // Only one element, and all other children are whitespace
            var foundElement = false;
            for (var i = 0, count = containerEl.childNodes.length; i < count; i++) {
                var child = containerEl.childNodes[i];
                // Edited by RequireSun 2017-06-27
                // fixed the bug of returns true when there's only a comment node
                // and a DOM node at the top level
                if (child.nodeType === NODE_TYPE.COMMENT || child.nodeType === NODE_TYPE.ELEMENT) {
                    if (foundElement) {
                        // Encountered an element after already encountering another one
                        // Therefore, more than one element at root level
                        return false;
                    } else {
                        foundElement = true;
                    }
                } else if (child.nodeType === NODE_TYPE.TEXT && !isEmpty(child.textContent)) {
                    // Contains text content
                    return false;
                }
            }
            return true;
        },

        /**
         * Gets a newline followed by the correct indentation for the current
         * nesting level
         *
         * @return {string}
         */
        _getIndentedNewline: function _getIndentedNewline() {
            return '\n' + repeatString(this.config.indent, this.level + (this.config.createClass ? 2 : -1));
        },

        /**
         * Handles processing the specified node
         *
         * @param {Node} node
         */
        _visit: function _visit(node) {
            this._beginVisit(node);
            this._traverse(node);
            this._endVisit(node);
        },

        /**
         * Traverses all the children of the specified node
         *
         * @param {Node} node
         */
        _traverse: function _traverse(node) {
            this.level++;
            for (var i = 0, count = node.childNodes.length; i < count; i++) {
                this._visit(node.childNodes[i]);
            }
            this.level--;
        },

        /**
         * Handle pre-visit behaviour for the specified node.
         *
         * @param {Node} node
         */
        _beginVisit: function _beginVisit(node) {
            switch (node.nodeType) {
                case NODE_TYPE.ELEMENT:
                    this._beginVisitElement(node);
                    break;

                case NODE_TYPE.TEXT:
                    this._visitText(node);
                    break;

                case NODE_TYPE.COMMENT:
                    this._visitComment(node);
                    break;

                default:
                    console.warn('Unrecognised node type: ' + node.nodeType);
            }
        },

        /**
         * Handles post-visit behaviour for the specified node.
         *
         * @param {Node} node
         */
        _endVisit: function _endVisit(node) {
            switch (node.nodeType) {
                case NODE_TYPE.ELEMENT:
                    this._endVisitElement(node);
                    break;
                // No ending tags required for these types
                case NODE_TYPE.TEXT:
                case NODE_TYPE.COMMENT:
                    break;
            }
        },

        /**
         * Handles pre-visit behaviour for the specified element node
         *
         * @param {DOMElement} node
         */
        _beginVisitElement: function _beginVisitElement(node) {
            var tagName = node.tagName.toLowerCase();
            var attributes = [];
            for (var i = 0, count = node.attributes.length; i < count; i++) {
                attributes.push(this._getElementAttribute(node, node.attributes[i]));
            }

            if (tagName === 'textarea') {
                // Hax: textareas need their inner text moved to a "defaultValue" attribute.
                attributes.push('defaultValue={' + JSON.stringify(node.value) + '}');
            }
            if (tagName === 'style') {
                // Hax: style tag contents need to be dangerously set due to liberal curly brace usage
                attributes.push('dangerouslySetInnerHTML={{__html: ' + JSON.stringify(node.textContent) + ' }}');
            }
            if (tagName === 'pre') {
                this._inPreTag = true;
            }
            //[AHP]: setDefault Value of  Text
            if (tagName === 'input' && attributes.indexOf('Text') > -1 && attributes.indexOf('value') < 0) {
                attributes.push('defaultValue=""');
            }

            this.output += '<' + tagName;
            if (attributes.length > 0) {
                this.output += ' ' + attributes.join(' ');
            }
            if (!this._isSelfClosing(node)) {
                this.output += '>';
            }
        },

        /**
         * Handles post-visit behaviour for the specified element node
         *
         * @param {Node} node
         */
        _endVisitElement: function _endVisitElement(node) {
            var tagName = node.tagName.toLowerCase();
            // De-indent a bit
            // TODO: It's inefficient to do it this way :/
            this.output = trimEnd(this.output, this.config.indent);
            if (this._isSelfClosing(node)) {
                this.output += ' />';
            } else {
                this.output += '</' + node.tagName.toLowerCase() + '>';
            }

            if (tagName === 'pre') {
                this._inPreTag = false;
            }
        },

        /**
         * Determines if this element node should be rendered as a self-closing
         * tag.
         *
         * @param {Node} node
         * @return {boolean}
         */
        _isSelfClosing: function _isSelfClosing(node) {
            // If it has children, it's not self-closing
            // Exception: All children of a textarea are moved to a "defaultValue" attribute, style attributes are dangerously set.
            return !node.firstChild || node.tagName.toLowerCase() === 'textarea' || node.tagName.toLowerCase() === 'style';
        },

        /**
         * Handles processing of the specified text node
         *
         * @param {TextNode} node
         */
        _visitText: function _visitText(node) {
            var parentTag = node.parentNode && node.parentNode.tagName.toLowerCase();
            if (parentTag === 'textarea' || parentTag === 'style') {
                // Ignore text content of textareas and styles, as it will have already been moved
                // to a "defaultValue" attribute and "dangerouslySetInnerHTML" attribute respectively.
                return;
            }

            var text = escapeSpecialChars(node.textContent);

            if (this._inPreTag) {
                // If this text is contained within a <pre>, we need to ensure the JSX
                // whitespace coalescing rules don't eat the whitespace. This means
                // wrapping newlines and sequences of two or more spaces in variables.
                text = text.replace(/\r/g, '').replace(/( {2,}|\n|\t|\{|\})/g, function (whitespace) {
                    return '{' + JSON.stringify(whitespace) + '}';
                });
            } else {
                // Handle any curly braces.
                text = text.replace(/(\{|\})/g, function (brace) {
                    return '{\'' + brace + '\'}';
                });
                // If there's a newline in the text, adjust the indent level
                if (text.indexOf('\n') > -1) {
                    text = text.replace(/\n\s*/g, this._getIndentedNewline());
                }
            }
            this.output += text;
        },

        /**
         * Handles processing of the specified text node
         *
         * @param {Text} node
         */
        _visitComment: function _visitComment(node) {
            if (this.config.hideComment) {
                this.output = this.output.replace(/\s+$/, '');
            } else {
                this.output += '{/*' + node.textContent.replace('*/', '* /') + '*/}';
            }
        },

        /**
         * Gets a JSX formatted version of the specified attribute from the node
         *
         * @param {DOMElement} node
         * @param {object}     attribute
         * @return {string}
         */
        _getElementAttribute: function _getElementAttribute(node, attribute) {
            switch (attribute.name) {
                case 'style':
                    return this._getStyleAttribute(attribute.value);
                default:
                    var arrEvt = "onblur,onchange,onfocus,onclick,ondblclick,onkeypress,onkeyup,onkeydown,onmousedown".split(",");
                    var tagName = node.tagName.toLowerCase();
                    var name = ELEMENT_ATTRIBUTE_MAPPING[tagName] && ELEMENT_ATTRIBUTE_MAPPING[tagName][attribute.name] || ATTRIBUTE_MAPPING[attribute.name] || -1 < SVG_TAG_MAPPING.indexOf(tagName) && SVG_ATTRIBUTE_MAPPING[attribute.name] || attribute.name;
                    var result = name;
                    var _rplThis = '$sf("'+node.id+'")';
                    
                    if (-1 < name.indexOf(':')) {
                        // value has ':' will make error
                        result = '';
                    } else if (isNumeric(attribute.value)) {
                        // Numeric values should be output as {123} not "123"
                        //Condition 01 - 0,1
                        if (attribute.value.substring(0, 1) == '0' && attribute.value.substring(0, 2) != '0.'){
                            result += '="' + attribute.value.replace(/"/gm, '&quot;') + '"';
                        }else{
                            result += '={' + attribute.value + '}';   
                        }
                    } else if(name == 'data-showif'){
                        if(attribute.value.length > 0){
                            result += '="<SF7SHOWIF>\''+node.id+'\'='+ attribute.value.replace(/"/gm, '&quot;')+'</SF7SHOWIF>"';
                        }else{
                            result += '=""';
                        }
                    } else if (attribute.value.length > 0) {
                        //[AHP]: Pemanggilan function tidak boleh di jadikan string 
                        if(arrEvt.indexOf(name) > -1){
                            if(node.id != ""){ 
                                result += '={() => {' + attribute.value.replace(/"/gm, '&quot;').replace(/this/gm, _rplThis).replace(RegExp('formodified(this);','gi'),'formodified('+_rplThis+');') + '}}';
                            }else{
                                result += '={() => {' + attribute.value.replace(/"/gm, '&quot;').replace(/this.blur\(\);/gm, '').replace(/this.blur\(\)/gm, '') + '}}';
                            }
                            
                        }else{
                            result += '="' + attribute.value.replace(/"/gm, '&quot;') + '"';
                        }
                    } else if(name == 'title' || name == 'value' || name == 'defaultvalue'){
                        if(attribute.value.length > 0){
                            result += '="' + attribute.value.replace(/"/gm, '&quot;') + '"';
                        }else{
                            result += '=""';
                        }
                    }

                    return result;
            }
        },

        /**
         * Gets a JSX formatted version of the specified element styles
         *
         * @param {string} styles
         * @return {string}
         */
        _getStyleAttribute: function _getStyleAttribute(styles) {
            var jsxStyles = new StyleParser(styles).toJSXString();
            return 'style={{' + jsxStyles + '}}';
        }
    };

    return htmltojsx;
};

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Created by kelvinsun on 2017/6/27.
 */
var createElement = function createElement(tag) {
  return document.createElement(tag);
};
module.exports = __webpack_require__(0)(createElement);

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 */



/**
 * Use invariant() to assert state which your program assumes to be true.
 *
 * Provide sprintf-style format (only %s is supported) and arguments
 * to provide information about what broke and what you were
 * expecting.
 *
 * The invariant message will be stripped in production, but the invariant
 * will remain to ensure logic does not differ in production.
 */

var validateFormat = function validateFormat(format) {};

if (false) {
  validateFormat = function validateFormat(format) {
    if (format === undefined) {
      throw new Error('invariant requires an error message argument');
    }
  };
}

function invariant(condition, format, a, b, c, d, e, f) {
  validateFormat(format);

  if (!condition) {
    var error;
    if (format === undefined) {
      error = new Error('Minified exception occurred; use the non-minified dev environment ' + 'for the full error message and additional helpful warnings.');
    } else {
      var args = [a, b, c, d, e, f];
      var argIndex = 0;
      error = new Error(format.replace(/%s/g, function () {
        return args[argIndex++];
      }));
      error.name = 'Invariant Violation';
    }

    error.framesToPop = 1; // we don't care about invariant's own frame
    throw error;
  }
}

module.exports = invariant;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Copyright 2013-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 */
var _prodInvariant = __webpack_require__(6);

var invariant = __webpack_require__(2);

function checkMask(value, bitmask) {
  return (value & bitmask) === bitmask;
}

var DOMPropertyInjection = {
  /**
   * Mapping from normalized, camelcased property names to a configuration that
   * specifies how the associated DOM property should be accessed or rendered.
   */
  MUST_USE_PROPERTY: 0x1,
  HAS_BOOLEAN_VALUE: 0x4,
  HAS_NUMERIC_VALUE: 0x8,
  HAS_POSITIVE_NUMERIC_VALUE: 0x10 | 0x8,
  HAS_OVERLOADED_BOOLEAN_VALUE: 0x20,

  /**
   * Inject some specialized knowledge about the DOM. This takes a config object
   * with the following properties:
   *
   * isCustomAttribute: function that given an attribute name will return true
   * if it can be inserted into the DOM verbatim. Useful for data-* or aria-*
   * attributes where it's impossible to enumerate all of the possible
   * attribute names,
   *
   * Properties: object mapping DOM property name to one of the
   * DOMPropertyInjection constants or null. If your attribute isn't in here,
   * it won't get written to the DOM.
   *
   * DOMAttributeNames: object mapping React attribute name to the DOM
   * attribute name. Attribute names not specified use the **lowercase**
   * normalized name.
   *
   * DOMAttributeNamespaces: object mapping React attribute name to the DOM
   * attribute namespace URL. (Attribute names not specified use no namespace.)
   *
   * DOMPropertyNames: similar to DOMAttributeNames but for DOM properties.
   * Property names not specified use the normalized name.
   *
   * DOMMutationMethods: Properties that require special mutation methods. If
   * `value` is undefined, the mutation method should unset the property.
   *
   * @param {object} domPropertyConfig the config as described above.
   */
  injectDOMPropertyConfig: function (domPropertyConfig) {
    var Injection = DOMPropertyInjection;
    var Properties = domPropertyConfig.Properties || {};
    var DOMAttributeNamespaces = domPropertyConfig.DOMAttributeNamespaces || {};
    var DOMAttributeNames = domPropertyConfig.DOMAttributeNames || {};
    var DOMPropertyNames = domPropertyConfig.DOMPropertyNames || {};
    var DOMMutationMethods = domPropertyConfig.DOMMutationMethods || {};

    if (domPropertyConfig.isCustomAttribute) {
      DOMProperty._isCustomAttributeFunctions.push(domPropertyConfig.isCustomAttribute);
    }

    for (var propName in Properties) {
      !!DOMProperty.properties.hasOwnProperty(propName) ?  false ? invariant(false, 'injectDOMPropertyConfig(...): You\'re trying to inject DOM property \'%s\' which has already been injected. You may be accidentally injecting the same DOM property config twice, or you may be injecting two configs that have conflicting property names.', propName) : _prodInvariant('48', propName) : void 0;

      var lowerCased = propName.toLowerCase();
      var propConfig = Properties[propName];

      var propertyInfo = {
        attributeName: lowerCased,
        attributeNamespace: null,
        propertyName: propName,
        mutationMethod: null,

        mustUseProperty: checkMask(propConfig, Injection.MUST_USE_PROPERTY),
        hasBooleanValue: checkMask(propConfig, Injection.HAS_BOOLEAN_VALUE),
        hasNumericValue: checkMask(propConfig, Injection.HAS_NUMERIC_VALUE),
        hasPositiveNumericValue: checkMask(propConfig, Injection.HAS_POSITIVE_NUMERIC_VALUE),
        hasOverloadedBooleanValue: checkMask(propConfig, Injection.HAS_OVERLOADED_BOOLEAN_VALUE)
      };
      !(propertyInfo.hasBooleanValue + propertyInfo.hasNumericValue + propertyInfo.hasOverloadedBooleanValue <= 1) ?  false ? invariant(false, 'DOMProperty: Value can be one of boolean, overloaded boolean, or numeric value, but not a combination: %s', propName) : _prodInvariant('50', propName) : void 0;

      if (false) {
        DOMProperty.getPossibleStandardName[lowerCased] = propName;
      }

      if (DOMAttributeNames.hasOwnProperty(propName)) {
        var attributeName = DOMAttributeNames[propName];
        propertyInfo.attributeName = attributeName;
        if (false) {
          DOMProperty.getPossibleStandardName[attributeName] = propName;
        }
      }

      if (DOMAttributeNamespaces.hasOwnProperty(propName)) {
        propertyInfo.attributeNamespace = DOMAttributeNamespaces[propName];
      }

      if (DOMPropertyNames.hasOwnProperty(propName)) {
        propertyInfo.propertyName = DOMPropertyNames[propName];
      }

      if (DOMMutationMethods.hasOwnProperty(propName)) {
        propertyInfo.mutationMethod = DOMMutationMethods[propName];
      }

      DOMProperty.properties[propName] = propertyInfo;
    }
  }
};

/* eslint-disable max-len */
var ATTRIBUTE_NAME_START_CHAR = ':A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD';
/* eslint-enable max-len */

/**
 * DOMProperty exports lookup objects that can be used like functions:
 *
 *   > DOMProperty.isValid['id']
 *   true
 *   > DOMProperty.isValid['foobar']
 *   undefined
 *
 * Although this may be confusing, it performs better in general.
 *
 * @see http://jsperf.com/key-exists
 * @see http://jsperf.com/key-missing
 */
var DOMProperty = {
  ID_ATTRIBUTE_NAME: 'data-reactid',
  ROOT_ATTRIBUTE_NAME: 'data-reactroot',

  ATTRIBUTE_NAME_START_CHAR: ATTRIBUTE_NAME_START_CHAR,
  ATTRIBUTE_NAME_CHAR: ATTRIBUTE_NAME_START_CHAR + '\\-.0-9\\u00B7\\u0300-\\u036F\\u203F-\\u2040',

  /**
   * Map from property "standard name" to an object with info about how to set
   * the property in the DOM. Each object contains:
   *
   * attributeName:
   *   Used when rendering markup or with `*Attribute()`.
   * attributeNamespace
   * propertyName:
   *   Used on DOM node instances. (This includes properties that mutate due to
   *   external factors.)
   * mutationMethod:
   *   If non-null, used instead of the property or `setAttribute()` after
   *   initial render.
   * mustUseProperty:
   *   Whether the property must be accessed and mutated as an object property.
   * hasBooleanValue:
   *   Whether the property should be removed when set to a falsey value.
   * hasNumericValue:
   *   Whether the property must be numeric or parse as a numeric and should be
   *   removed when set to a falsey value.
   * hasPositiveNumericValue:
   *   Whether the property must be positive numeric or parse as a positive
   *   numeric and should be removed when set to a falsey value.
   * hasOverloadedBooleanValue:
   *   Whether the property can be used as a flag as well as with a value.
   *   Removed when strictly equal to false; present without a value when
   *   strictly equal to true; present with a value otherwise.
   */
  properties: {},

  /**
   * Mapping from lowercase property names to the properly cased version, used
   * to warn in the case of missing properties. Available only in __DEV__.
   *
   * autofocus is predefined, because adding it to the property whitelist
   * causes unintended side effects.
   *
   * @type {Object}
   */
  getPossibleStandardName:  false ? { autofocus: 'autoFocus' } : null,

  /**
   * All of the isCustomAttribute() functions that have been injected.
   */
  _isCustomAttributeFunctions: [],

  /**
   * Checks whether a property name is a custom attribute.
   * @method
   */
  isCustomAttribute: function (attributeName) {
    for (var i = 0; i < DOMProperty._isCustomAttributeFunctions.length; i++) {
      var isCustomAttributeFn = DOMProperty._isCustomAttributeFunctions[i];
      if (isCustomAttributeFn(attributeName)) {
        return true;
      }
    }
    return false;
  },

  injection: DOMPropertyInjection
};

module.exports = DOMProperty;

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Copyright 2013-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 */
var DOMProperty = __webpack_require__(3);

var MUST_USE_PROPERTY = DOMProperty.injection.MUST_USE_PROPERTY;
var HAS_BOOLEAN_VALUE = DOMProperty.injection.HAS_BOOLEAN_VALUE;
var HAS_NUMERIC_VALUE = DOMProperty.injection.HAS_NUMERIC_VALUE;
var HAS_POSITIVE_NUMERIC_VALUE = DOMProperty.injection.HAS_POSITIVE_NUMERIC_VALUE;
var HAS_OVERLOADED_BOOLEAN_VALUE = DOMProperty.injection.HAS_OVERLOADED_BOOLEAN_VALUE;

var HTMLDOMPropertyConfig = {
  isCustomAttribute: RegExp.prototype.test.bind(new RegExp('^(data|aria)-[' + DOMProperty.ATTRIBUTE_NAME_CHAR + ']*$')),
  Properties: {
    /**
     * Standard Properties
     */
    accept: 0,
    acceptCharset: 0,
    accessKey: 0,
    action: 0,
    allowFullScreen: HAS_BOOLEAN_VALUE,
    allowTransparency: 0,
    alt: 0,
    // specifies target context for links with `preload` type
    as: 0,
    async: HAS_BOOLEAN_VALUE,
    autoComplete: 0,
    // autoFocus is polyfilled/normalized by AutoFocusUtils
    // autoFocus: HAS_BOOLEAN_VALUE,
    autoPlay: HAS_BOOLEAN_VALUE,
    capture: HAS_BOOLEAN_VALUE,
    cellPadding: 0,
    cellSpacing: 0,
    charSet: 0,
    challenge: 0,
    checked: MUST_USE_PROPERTY | HAS_BOOLEAN_VALUE,
    cite: 0,
    classID: 0,
    className: 0,
    cols: HAS_POSITIVE_NUMERIC_VALUE,
    colSpan: 0,
    content: 0,
    contentEditable: 0,
    contextMenu: 0,
    controls: HAS_BOOLEAN_VALUE,
    coords: 0,
    crossOrigin: 0,
    data: 0, // For `<object />` acts as `src`.
    dateTime: 0,
    'default': HAS_BOOLEAN_VALUE,
    defer: HAS_BOOLEAN_VALUE,
    dir: 0,
    disabled: HAS_BOOLEAN_VALUE,
    download: HAS_OVERLOADED_BOOLEAN_VALUE,
    draggable: 0,
    encType: 0,
    form: 0,
    formAction: 0,
    formEncType: 0,
    formMethod: 0,
    formNoValidate: HAS_BOOLEAN_VALUE,
    formTarget: 0,
    frameBorder: 0,
    headers: 0,
    height: 0,
    hidden: HAS_BOOLEAN_VALUE,
    high: 0,
    href: 0,
    hrefLang: 0,
    htmlFor: 0,
    httpEquiv: 0,
    icon: 0,
    id: 0,
    inputMode: 0,
    integrity: 0,
    is: 0,
    keyParams: 0,
    keyType: 0,
    kind: 0,
    label: 0,
    lang: 0,
    list: 0,
    loop: HAS_BOOLEAN_VALUE,
    low: 0,
    manifest: 0,
    marginHeight: 0,
    marginWidth: 0,
    max: 0,
    maxLength: 0,
    media: 0,
    mediaGroup: 0,
    method: 0,
    min: 0,
    minLength: 0,
    // Caution; `option.selected` is not updated if `select.multiple` is
    // disabled with `removeAttribute`.
    multiple: MUST_USE_PROPERTY | HAS_BOOLEAN_VALUE,
    muted: MUST_USE_PROPERTY | HAS_BOOLEAN_VALUE,
    name: 0,
    nonce: 0,
    noValidate: HAS_BOOLEAN_VALUE,
    open: HAS_BOOLEAN_VALUE,
    optimum: 0,
    pattern: 0,
    placeholder: 0,
    playsInline: HAS_BOOLEAN_VALUE,
    poster: 0,
    preload: 0,
    profile: 0,
    radioGroup: 0,
    readOnly: HAS_BOOLEAN_VALUE,
    referrerPolicy: 0,
    rel: 0,
    required: HAS_BOOLEAN_VALUE,
    reversed: HAS_BOOLEAN_VALUE,
    role: 0,
    rows: HAS_POSITIVE_NUMERIC_VALUE,
    rowSpan: HAS_NUMERIC_VALUE,
    sandbox: 0,
    scope: 0,
    scoped: HAS_BOOLEAN_VALUE,
    scrolling: 0,
    seamless: HAS_BOOLEAN_VALUE,
    selected: MUST_USE_PROPERTY | HAS_BOOLEAN_VALUE,
    shape: 0,
    size: HAS_POSITIVE_NUMERIC_VALUE,
    sizes: 0,
    span: HAS_POSITIVE_NUMERIC_VALUE,
    spellCheck: 0,
    src: 0,
    srcDoc: 0,
    srcLang: 0,
    srcSet: 0,
    start: HAS_NUMERIC_VALUE,
    step: 0,
    style: 0,
    summary: 0,
    tabIndex: 0,
    target: 0,
    title: 0,
    // Setting .type throws on non-<input> tags
    type: 0,
    useMap: 0,
    value: 0,
    width: 0,
    wmode: 0,
    wrap: 0,

    /**
     * RDFa Properties
     */
    about: 0,
    datatype: 0,
    inlist: 0,
    prefix: 0,
    // property is also supported for OpenGraph in meta tags.
    property: 0,
    resource: 0,
    'typeof': 0,
    vocab: 0,

    /**
     * Non-standard Properties
     */
    // autoCapitalize and autoCorrect are supported in Mobile Safari for
    // keyboard hints.
    autoCapitalize: 0,
    autoCorrect: 0,
    // autoSave allows WebKit/Blink to persist values of input fields on page reloads
    autoSave: 0,
    // color is for Safari mask-icon link
    color: 0,
    // itemProp, itemScope, itemType are for
    // Microdata support. See http://schema.org/docs/gs.html
    itemProp: 0,
    itemScope: HAS_BOOLEAN_VALUE,
    itemType: 0,
    // itemID and itemRef are for Microdata support as well but
    // only specified in the WHATWG spec document. See
    // https://html.spec.whatwg.org/multipage/microdata.html#microdata-dom-api
    itemID: 0,
    itemRef: 0,
    // results show looking glass icon and recent searches on input
    // search fields in WebKit/Blink
    results: 0,
    // IE-only attribute that specifies security restrictions on an iframe
    // as an alternative to the sandbox attribute on IE<10
    security: 0,
    // IE-only attribute that controls focus behavior
    unselectable: 0
  },
  DOMAttributeNames: {
    acceptCharset: 'accept-charset',
    className: 'class',
    htmlFor: 'for',
    httpEquiv: 'http-equiv'
  },
  DOMPropertyNames: {},
  DOMMutationMethods: {
    value: function (node, value) {
      if (value == null) {
        return node.removeAttribute('value');
      }

      // Number inputs get special treatment due to some edge cases in
      // Chrome. Let everything else assign the value attribute as normal.
      // https://github.com/facebook/react/issues/7253#issuecomment-236074326
      if (node.type !== 'number' || node.hasAttribute('value') === false) {
        //[AHP]: replace value'' to empty string:
        node.setAttribute('value', '' + value);
        //node.setAttribute('value', '');
      } else if (node.validity && !node.validity.badInput && node.ownerDocument.activeElement !== node) {
        // Don't assign an attribute if validation reports bad
        // input. Chrome will clear the value. Additionally, don't
        // operate on inputs that have focus, otherwise Chrome might
        // strip off trailing decimal places and cause the user's
        // cursor position to jump to the beginning of the input.
        //
        // In ReactDOMInput, we have an onBlur event that will trigger
        // this function again when focus is lost.
        //[AHP]: replace value'' to empty string:
        node.setAttribute('value', '' + value);
        //node.setAttribute('value', '');
      }
    }
  }
};

module.exports = HTMLDOMPropertyConfig;

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Copyright 2013-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 */
var NS = {
  xlink: 'http://www.w3.org/1999/xlink',
  xml: 'http://www.w3.org/XML/1998/namespace'
};

// We use attributes for everything SVG so let's avoid some duplication and run
// code instead.
// The following are all specified in the HTML config already so we exclude here.
// - class (as className)
// - color
// - height
// - id
// - lang
// - max
// - media
// - method
// - min
// - name
// - style
// - target
// - type
// - width
var ATTRS = {
  accentHeight: 'accent-height',
  accumulate: 0,
  additive: 0,
  alignmentBaseline: 'alignment-baseline',
  allowReorder: 'allowReorder',
  alphabetic: 0,
  amplitude: 0,
  arabicForm: 'arabic-form',
  ascent: 0,
  attributeName: 'attributeName',
  attributeType: 'attributeType',
  autoReverse: 'autoReverse',
  azimuth: 0,
  baseFrequency: 'baseFrequency',
  baseProfile: 'baseProfile',
  baselineShift: 'baseline-shift',
  bbox: 0,
  begin: 0,
  bias: 0,
  by: 0,
  calcMode: 'calcMode',
  capHeight: 'cap-height',
  clip: 0,
  clipPath: 'clip-path',
  clipRule: 'clip-rule',
  clipPathUnits: 'clipPathUnits',
  colorInterpolation: 'color-interpolation',
  colorInterpolationFilters: 'color-interpolation-filters',
  colorProfile: 'color-profile',
  colorRendering: 'color-rendering',
  contentScriptType: 'contentScriptType',
  contentStyleType: 'contentStyleType',
  cursor: 0,
  cx: 0,
  cy: 0,
  d: 0,
  decelerate: 0,
  descent: 0,
  diffuseConstant: 'diffuseConstant',
  direction: 0,
  display: 0,
  divisor: 0,
  dominantBaseline: 'dominant-baseline',
  dur: 0,
  dx: 0,
  dy: 0,
  edgeMode: 'edgeMode',
  elevation: 0,
  enableBackground: 'enable-background',
  end: 0,
  exponent: 0,
  externalResourcesRequired: 'externalResourcesRequired',
  fill: 0,
  fillOpacity: 'fill-opacity',
  fillRule: 'fill-rule',
  filter: 0,
  filterRes: 'filterRes',
  filterUnits: 'filterUnits',
  floodColor: 'flood-color',
  floodOpacity: 'flood-opacity',
  focusable: 0,
  fontFamily: 'font-family',
  fontSize: 'font-size',
  fontSizeAdjust: 'font-size-adjust',
  fontStretch: 'font-stretch',
  fontStyle: 'font-style',
  fontVariant: 'font-variant',
  fontWeight: 'font-weight',
  format: 0,
  from: 0,
  fx: 0,
  fy: 0,
  g1: 0,
  g2: 0,
  glyphName: 'glyph-name',
  glyphOrientationHorizontal: 'glyph-orientation-horizontal',
  glyphOrientationVertical: 'glyph-orientation-vertical',
  glyphRef: 'glyphRef',
  gradientTransform: 'gradientTransform',
  gradientUnits: 'gradientUnits',
  hanging: 0,
  horizAdvX: 'horiz-adv-x',
  horizOriginX: 'horiz-origin-x',
  ideographic: 0,
  imageRendering: 'image-rendering',
  'in': 0,
  in2: 0,
  intercept: 0,
  k: 0,
  k1: 0,
  k2: 0,
  k3: 0,
  k4: 0,
  kernelMatrix: 'kernelMatrix',
  kernelUnitLength: 'kernelUnitLength',
  kerning: 0,
  keyPoints: 'keyPoints',
  keySplines: 'keySplines',
  keyTimes: 'keyTimes',
  lengthAdjust: 'lengthAdjust',
  letterSpacing: 'letter-spacing',
  lightingColor: 'lighting-color',
  limitingConeAngle: 'limitingConeAngle',
  local: 0,
  markerEnd: 'marker-end',
  markerMid: 'marker-mid',
  markerStart: 'marker-start',
  markerHeight: 'markerHeight',
  markerUnits: 'markerUnits',
  markerWidth: 'markerWidth',
  mask: 0,
  maskContentUnits: 'maskContentUnits',
  maskUnits: 'maskUnits',
  mathematical: 0,
  mode: 0,
  numOctaves: 'numOctaves',
  offset: 0,
  opacity: 0,
  operator: 0,
  order: 0,
  orient: 0,
  orientation: 0,
  origin: 0,
  overflow: 0,
  overlinePosition: 'overline-position',
  overlineThickness: 'overline-thickness',
  paintOrder: 'paint-order',
  panose1: 'panose-1',
  pathLength: 'pathLength',
  patternContentUnits: 'patternContentUnits',
  patternTransform: 'patternTransform',
  patternUnits: 'patternUnits',
  pointerEvents: 'pointer-events',
  points: 0,
  pointsAtX: 'pointsAtX',
  pointsAtY: 'pointsAtY',
  pointsAtZ: 'pointsAtZ',
  preserveAlpha: 'preserveAlpha',
  preserveAspectRatio: 'preserveAspectRatio',
  primitiveUnits: 'primitiveUnits',
  r: 0,
  radius: 0,
  refX: 'refX',
  refY: 'refY',
  renderingIntent: 'rendering-intent',
  repeatCount: 'repeatCount',
  repeatDur: 'repeatDur',
  requiredExtensions: 'requiredExtensions',
  requiredFeatures: 'requiredFeatures',
  restart: 0,
  result: 0,
  rotate: 0,
  rx: 0,
  ry: 0,
  scale: 0,
  seed: 0,
  shapeRendering: 'shape-rendering',
  slope: 0,
  spacing: 0,
  specularConstant: 'specularConstant',
  specularExponent: 'specularExponent',
  speed: 0,
  spreadMethod: 'spreadMethod',
  startOffset: 'startOffset',
  stdDeviation: 'stdDeviation',
  stemh: 0,
  stemv: 0,
  stitchTiles: 'stitchTiles',
  stopColor: 'stop-color',
  stopOpacity: 'stop-opacity',
  strikethroughPosition: 'strikethrough-position',
  strikethroughThickness: 'strikethrough-thickness',
  string: 0,
  stroke: 0,
  strokeDasharray: 'stroke-dasharray',
  strokeDashoffset: 'stroke-dashoffset',
  strokeLinecap: 'stroke-linecap',
  strokeLinejoin: 'stroke-linejoin',
  strokeMiterlimit: 'stroke-miterlimit',
  strokeOpacity: 'stroke-opacity',
  strokeWidth: 'stroke-width',
  surfaceScale: 'surfaceScale',
  systemLanguage: 'systemLanguage',
  tableValues: 'tableValues',
  targetX: 'targetX',
  targetY: 'targetY',
  textAnchor: 'text-anchor',
  textDecoration: 'text-decoration',
  textRendering: 'text-rendering',
  textLength: 'textLength',
  to: 0,
  transform: 0,
  u1: 0,
  u2: 0,
  underlinePosition: 'underline-position',
  underlineThickness: 'underline-thickness',
  unicode: 0,
  unicodeBidi: 'unicode-bidi',
  unicodeRange: 'unicode-range',
  unitsPerEm: 'units-per-em',
  vAlphabetic: 'v-alphabetic',
  vHanging: 'v-hanging',
  vIdeographic: 'v-ideographic',
  vMathematical: 'v-mathematical',
  values: 0,
  vectorEffect: 'vector-effect',
  version: 0,
  vertAdvY: 'vert-adv-y',
  vertOriginX: 'vert-origin-x',
  vertOriginY: 'vert-origin-y',
  viewBox: 'viewBox',
  viewTarget: 'viewTarget',
  visibility: 0,
  widths: 0,
  wordSpacing: 'word-spacing',
  writingMode: 'writing-mode',
  x: 0,
  xHeight: 'x-height',
  x1: 0,
  x2: 0,
  xChannelSelector: 'xChannelSelector',
  xlinkActuate: 'xlink:actuate',
  xlinkArcrole: 'xlink:arcrole',
  xlinkHref: 'xlink:href',
  xlinkRole: 'xlink:role',
  xlinkShow: 'xlink:show',
  xlinkTitle: 'xlink:title',
  xlinkType: 'xlink:type',
  xmlBase: 'xml:base',
  xmlns: 0,
  xmlnsXlink: 'xmlns:xlink',
  xmlLang: 'xml:lang',
  xmlSpace: 'xml:space',
  y: 0,
  y1: 0,
  y2: 0,
  yChannelSelector: 'yChannelSelector',
  z: 0,
  zoomAndPan: 'zoomAndPan'
};

var SVGDOMPropertyConfig = {
  Properties: {},
  DOMAttributeNamespaces: {
    xlinkActuate: NS.xlink,
    xlinkArcrole: NS.xlink,
    xlinkHref: NS.xlink,
    xlinkRole: NS.xlink,
    xlinkShow: NS.xlink,
    xlinkTitle: NS.xlink,
    xlinkType: NS.xlink,
    xmlBase: NS.xml,
    xmlLang: NS.xml,
    xmlSpace: NS.xml
  },
  DOMAttributeNames: {}
};

Object.keys(ATTRS).forEach(function (key) {
  SVGDOMPropertyConfig.Properties[key] = 0;
  if (ATTRS[key]) {
    SVGDOMPropertyConfig.DOMAttributeNames[key] = ATTRS[key];
  }
});

module.exports = SVGDOMPropertyConfig;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {
/*"use strict";*/
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * 
 */
/**
 * WARNING: DO NOT manually require this module.
 * This is a replacement for `invariant(...)` used by the error code system
 * and will _only_ be required by the corresponding babel pass.
 * It always throws.
 */
function reactProdInvariant(code) {
  var argCount = arguments.length - 1;

  var message = 'Minified React error #' + code + '; visit ' + 'http://facebook.github.io/react/docs/error-decoder.html?invariant=' + code;

  for (var argIdx = 0; argIdx < argCount; argIdx++) {
    message += '&args[]=' + encodeURIComponent(arguments[argIdx + 1]);
  }

  message += ' for the full message or use the non-minified dev environment' + ' for full errors and additional helpful warnings.';

  var error = new Error(message);
  error.name = 'Invariant Violation';
  error.framesToPop = 1; // we don't care about reactProdInvariant's own frame

  throw error;
}

module.exports = reactProdInvariant;

/***/ })
/******/ ]);
});